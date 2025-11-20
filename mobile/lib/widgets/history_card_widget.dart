import 'package:flutter/material.dart';
import 'package:mobile/helpers/color_helper.dart';

enum HistoryStatus { menang, kalah, berjalan }

class HistoryCard extends StatelessWidget {
  final String gambar;
  final String namaBarang;
  final HistoryStatus status;
  final String valueHargaSatu;
  final String valueHargaDua;
  final VoidCallback onTap;

  const HistoryCard({
    super.key,
    required this.gambar,
    required this.namaBarang,
    required this.status,
    required this.valueHargaSatu,
    required this.valueHargaDua,
    required this.onTap,
  });

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: onTap,
      child: Card(
        color: Colors.white,
        elevation: 0,
        clipBehavior: Clip.hardEdge,
        shape: RoundedRectangleBorder(
          side: BorderSide(color: Colors.grey.shade300, width: 1.0),
          borderRadius: BorderRadius.circular(12.0),
        ),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Stack(
              children: [
                Image.network(
                  gambar,
                  height: 300,
                  width: double.infinity,
                  fit: BoxFit.cover,
                  loadingBuilder: (context, child, loadingProgress) {
                    if (loadingProgress == null) return child;
                    return Container(
                      height: 300,
                      color: Colors.grey.shade200,
                      child: Center(
                        child: CircularProgressIndicator(
                          strokeWidth: 2,
                          value: loadingProgress.expectedTotalBytes != null
                              ? loadingProgress.cumulativeBytesLoaded /
                                    loadingProgress.expectedTotalBytes!
                              : null,
                        ),
                      ),
                    );
                  },
                  errorBuilder: (context, error, stackTrace) => Container(
                    height: 300,
                    color: Colors.grey.shade200,
                    child: Icon(
                      Icons.image_not_supported_outlined,
                      color: Colors.grey.shade400,
                      size: 48,
                    ),
                  ),
                ),

                _buildStatusBadge(status),
              ],
            ),

            Padding(
              padding: const EdgeInsets.all(12.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    namaBarang,
                    style: TextStyle(
                      fontWeight: FontWeight.w600,
                      fontSize: 16.5,
                      color: ColorHelper.fromHex('#1d2939'),
                    ),
                    maxLines: 2,
                    overflow: TextOverflow.ellipsis,
                  ),
                  const SizedBox(height: 12),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      _buildPriceColumn("Harga Awal", valueHargaSatu),
                      _buildPriceColumn(
                        "Harga Akhir",
                        valueHargaDua,
                        isHighestBid: true,
                      ),
                    ],
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildStatusBadge(HistoryStatus status) {
    if (status == HistoryStatus.berjalan) {
      return const SizedBox.shrink();
    }

    String text;
    Color backgroundColor;
    Color textColor = Colors.white;

    switch (status) {
      case HistoryStatus.menang:
        text = "Menang";
        backgroundColor = Colors.green.shade600;
        break;
      case HistoryStatus.kalah:
        text = "Kalah";
        backgroundColor = Colors.red.shade600;
        break;
      case HistoryStatus.berjalan:
        return const SizedBox.shrink();
    }

    return Positioned(
      top: 0.0,
      right: 0.0,
      child: Container(
        padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 4),
        decoration: BoxDecoration(
          color: backgroundColor,
          borderRadius: BorderRadius.only(bottomLeft: Radius.circular(8)),
        ),
        child: Text(
          text,
          style: TextStyle(
            color: textColor,
            fontWeight: FontWeight.w600,
            fontSize: 12,
          ),
        ),
      ),
    );
  }

  Widget _buildPriceColumn(
    String label,
    String price, {
    bool isHighestBid = false,
  }) {
    return Column(
      crossAxisAlignment: isHighestBid
          ? CrossAxisAlignment.end
          : CrossAxisAlignment.start,
      children: [
        Text(
          label,
          style: TextStyle(color: Colors.grey.shade600, fontSize: 14),
        ),
        const SizedBox(height: 2),
        Text(
          price,
          style: TextStyle(
            fontWeight: FontWeight.w700,
            fontSize: 16.5,
            color: ColorHelper.fromHex('#1d2939'),
          ),
        ),
      ],
    );
  }
}
