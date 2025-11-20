import 'package:flutter/material.dart';
import 'package:mobile/helpers/color_helper.dart';
import 'package:mobile/screens/auction_screen.dart';

class AuctionCard extends StatelessWidget {
  final String gambar;
  final String namaBarang;
  final String hargaAwal;
  final String tawaranTertinggi;
  final String namaTawaranTertinggi;
  final List<dynamic> historiLelang;
  final int idLelang;

  const AuctionCard({
    super.key,
    required this.gambar,
    required this.namaBarang,
    required this.hargaAwal,
    required this.tawaranTertinggi,
    required this.namaTawaranTertinggi,
    required this.historiLelang,
    required this.idLelang,
  });

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: () {
        Navigator.push(
          context,
          MaterialPageRoute(
            builder: (context) => AuctionScreen(idLelang: idLelang),
          ),
        );
      },
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
                      _buildPriceColumn('Harga Awal', hargaAwal),
                      _buildPriceColumn(
                        'Penawaran Tertinggi',
                        tawaranTertinggi,
                        isHighestBid: true,
                      ),
                    ],
                  ),
                  const SizedBox(height: 12),
                ],
              ),
            ),
          ],
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
