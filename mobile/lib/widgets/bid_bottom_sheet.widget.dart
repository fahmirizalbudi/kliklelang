// lib/widgets/bid_bottom_sheet.dart

import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:intl/intl.dart';
import 'package:mobile/helpers/color_helper.dart';
import 'package:mobile/widgets/edittext_widget.dart';

class BidBottomSheet extends StatefulWidget {
  // Menerima List<dynamic> sesuai permintaan API Anda
  final List<dynamic> bidHistoryList;
  final double currentHighestBidNumeric;
  final int idLelang;

  const BidBottomSheet({
    super.key,
    required this.bidHistoryList,
    required this.idLelang,
    required this.currentHighestBidNumeric,
  });

  @override
  State<BidBottomSheet> createState() => _BidBottomSheetState();
}

class _BidBottomSheetState extends State<BidBottomSheet> {
  late TextEditingController _bidController;

  final currencyFormatter = NumberFormat.currency(
    locale: 'id_ID',
    symbol: 'Rp ',
    decimalDigits: 0,
  );
  final timeFormatter = DateFormat('HH:mm, d MMM yyyy');

  @override
  void initState() {
    super.initState();
    _bidController = TextEditingController();
  }

  @override
  void dispose() {
    _bidController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: EdgeInsets.only(
        bottom: MediaQuery.of(context).viewInsets.bottom,
        left: 16,
        right: 16,
        top: 16,
      ),
      child: SingleChildScrollView(
        child: Column(
          mainAxisSize: MainAxisSize.min,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Center(
              child: Container(
                width: 40,
                height: 4,
                decoration: BoxDecoration(
                  color: Colors.grey.shade300,
                  borderRadius: BorderRadius.circular(2),
                ),
              ),
            ),
            const SizedBox(height: 16),
            const Text(
              "Riwayat Tawaran",
              style: TextStyle(fontSize: 18, fontWeight: FontWeight.w600),
            ),
            const SizedBox(height: 4),
            Text(
              "Bid saat ini: ${currencyFormatter.format(widget.currentHighestBidNumeric)}",
              style: TextStyle(
                fontSize: 14,
                fontWeight: FontWeight.w500,
                color: Colors.black87,
              ),
            ),
            const SizedBox(height: 12),

            Container(
              constraints: const BoxConstraints(maxHeight: 200),
              child: widget.bidHistoryList.isEmpty
                  ? Center(
                      child: Padding(
                        padding: const EdgeInsets.symmetric(vertical: 24.0),
                        child: Text(
                          "Belum ada tawaran.",
                          style: TextStyle(color: Colors.grey.shade600),
                        ),
                      ),
                    )
                  : ListView.builder(
                      shrinkWrap: true,
                      itemCount: widget.bidHistoryList.length,
                      itemBuilder: (context, index) {
                        final bid = widget.bidHistoryList[index] as dynamic;
                        return _buildHistoryTile(bid);
                      },
                    ),
            ),
            const SizedBox(height: 24),
            EditText(
              placeholder: 'Masukkan tawaran anda',
              controller: TextEditingController(),
              leftIcon: Icon(Icons.money, size: 22),
            ),
            const SizedBox(height: 16),
            SizedBox(
              width: double.infinity,
              child: ElevatedButton(
                onPressed: () async {},
                style: ElevatedButton.styleFrom(
                  backgroundColor: ColorHelper.fromHex('#465bff'),
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(8),
                  ),
                  padding: EdgeInsets.symmetric(horizontal: 40, vertical: 17),
                ),
                child: Text(
                  "Ajukan Penawaran",
                  style: TextStyle(color: Colors.white, fontSize: 16),
                ),
              ),
            ),
            const SizedBox(height: 16),
          ],
        ),
      ),
    );
  }

  Widget _buildHistoryTile(dynamic bid) {
    final int bidAmount = bid['penawaran_harga'];
    final String bidderInfo = "${bid['masyarakat']['nama_lengkap']}";
    final String timeString = bid['created_at'];

    DateTime timestamp;
    try {
      timestamp = DateTime.parse(timeString).toLocal();
    } catch (e) {
      timestamp = DateTime.now();
    }

    final isHighest = bidAmount == widget.currentHighestBidNumeric;

    return Container(
      padding: const EdgeInsets.symmetric(vertical: 8),
      decoration: BoxDecoration(
        border: Border(
          bottom: BorderSide(color: Colors.grey.shade200, width: 1),
        ),
      ),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(
                bidderInfo,
                style: TextStyle(
                  fontWeight: isHighest ? FontWeight.w700 : FontWeight.w500,
                  fontSize: 14,
                  color: Colors.black87,
                ),
              ),
              const SizedBox(height: 2),
              Text(
                timeFormatter.format(timestamp),
                style: TextStyle(fontSize: 12, color: Colors.grey.shade600),
              ),
            ],
          ),
          Text(
            currencyFormatter.format(bidAmount),
            style: TextStyle(
              fontWeight: isHighest ? FontWeight.w700 : FontWeight.w500,
              fontSize: 15,
              color: Colors.black87,
            ),
          ),
        ],
      ),
    );
  }
}
