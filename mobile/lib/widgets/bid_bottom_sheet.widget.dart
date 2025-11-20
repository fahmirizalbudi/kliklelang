import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'package:mobile/helpers/color_helper.dart';
import 'package:mobile/helpers/currency_helper.dart';
import 'package:mobile/helpers/toast_helper.dart';
import 'package:mobile/services/lelang_service.dart';
import 'package:mobile/widgets/edittext_widget.dart';

class BidBottomSheet extends StatefulWidget {
  final List<dynamic> historiLelang;
  final int tawaranTertinggi;
  final int idLelang;

  const BidBottomSheet({
    super.key,
    this.historiLelang = const [],
    required this.idLelang,
    required this.tawaranTertinggi,
  });

  @override
  State<BidBottomSheet> createState() => _BidBottomSheetState();
}

class _BidBottomSheetState extends State<BidBottomSheet> {
  final TextEditingController bidController = TextEditingController();
  final timeFormatter = DateFormat('HH:mm, d MMM yyyy');

  @override
  void initState() {
    super.initState();
  }

  @override
  void dispose() {
    bidController.dispose();
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
              "Penawaran saat ini: ${widget.tawaranTertinggi > 0 ? CurrencyHelper.formatRupiah(widget.tawaranTertinggi) : '-'}",
              style: TextStyle(
                fontSize: 14,
                fontWeight: FontWeight.w500,
                color: Colors.black87,
              ),
            ),
            const SizedBox(height: 12),

            Container(
              constraints: const BoxConstraints(maxHeight: 200),
              child: widget.historiLelang.isEmpty
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
                      itemCount: widget.historiLelang.length,
                      itemBuilder: (context, index) {
                        final bid = widget.historiLelang[index] as dynamic;
                        return _buildHistoryTile(bid);
                      },
                    ),
            ),
            const SizedBox(height: 24),
            EditText(
              placeholder: 'Masukkan tawaran anda',
              controller: bidController,
              leftIcon: Icon(Icons.money, size: 22),
            ),
            const SizedBox(height: 16),
            SizedBox(
              width: double.infinity,
              child: ElevatedButton(
                onPressed: () async {
                  int hargaBid = int.tryParse(bidController.text) ?? 0;
                  final ok = await LelangService().placeBid(
                    widget.idLelang,
                    hargaBid,
                  );
                  if (context.mounted && ok) {
                    Navigator.pop(context, true);
                    return;
                  }

                  ToastHelper.show(
                    'Penawaran Anda harus lebih tinggi dari penawaran sebelumnya!',
                  );
                },
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

    final isHighest = bidAmount == widget.tawaranTertinggi;

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
            CurrencyHelper.formatRupiah(bidAmount),
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
