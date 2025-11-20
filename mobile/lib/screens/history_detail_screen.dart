import 'package:flutter/material.dart';
import 'package:mobile/helpers/color_helper.dart';
import 'package:mobile/helpers/currency_helper.dart';
import 'package:mobile/helpers/url_helper.dart';
import 'package:mobile/services/lelang_service.dart';

class HistoryDetailScreen extends StatefulWidget {
  final int idLelang;

  const HistoryDetailScreen({super.key, required this.idLelang});

  @override
  State<HistoryDetailScreen> createState() => _HistoryDetailScreenState();
}

class _HistoryDetailScreenState extends State<HistoryDetailScreen> {
  late dynamic detailLelang;
  late String gambar;
  late String namaBarang;
  late String hargaAkhir;
  late String hargaAwal;
  late String pemenang;
  late String deskripsiBarang;
  late List<dynamic> historiLelang;
  bool isLoading = true;

  Future<void> fetchData() async {
    dynamic detailLelangData = await LelangService().getLelangDetail(
      widget.idLelang,
    );
    setState(() {
      detailLelang = detailLelangData;

      gambar = detailLelang['barang']['foto_barang'];
      namaBarang = detailLelang['barang']['nama_barang'];
      hargaAwal = CurrencyHelper.formatRupiah(
        detailLelang['barang']['harga_awal'],
      );
      deskripsiBarang = detailLelang['barang']['deskripsi_barang'];

      historiLelang = detailLelang['history_lelang'];

      if (detailLelang['masyarakat'] != null) {
        pemenang = detailLelang['masyarakat']['nama_lengkap'];
        hargaAkhir = CurrencyHelper.formatRupiah(detailLelang['harga_akhir']);
      } else {
        hargaAkhir = '-';
        pemenang = '-';
      }
      isLoading = false;
    });
  }

  @override
  void initState() {
    super.initState();
    fetchData();
  }

  @override
  Widget build(BuildContext context) {
    if (isLoading) {
      return const Scaffold(body: Center(child: CircularProgressIndicator()));
    }

    return Scaffold(
      backgroundColor: Colors.white,
      appBar: AppBar(
        scrolledUnderElevation: 0,
        toolbarHeight: 85,
        backgroundColor: Colors.white,
        elevation: 0,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back, color: Colors.black87),
          onPressed: () => Navigator.of(context).pop(),
        ),
        title: const Text(
          "Detail Histori Lelang",
          style: TextStyle(
            color: Colors.black87,
            fontSize: 17,
            fontWeight: FontWeight.w600,
          ),
        ),
        centerTitle: true,
      ),
      body: SingleChildScrollView(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Image.network(
              '${UrlHelper.getBaseUrl()}:8000/storage/foto_barang/$gambar',
              height: 300,
              width: double.infinity,
              fit: BoxFit.cover,
            ),
            Padding(
              padding: const EdgeInsets.all(16.0),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    namaBarang,
                    style: TextStyle(
                      fontWeight: FontWeight.w700,
                      fontSize: 22,
                      color: ColorHelper.fromHex('#1d2939'),
                    ),
                  ),
                  const SizedBox(height: 12),
                  Row(
                    children: [
                      Icon(
                        Icons.timer_outlined,
                        color: Colors.grey.shade700,
                        size: 20,
                      ),
                      const SizedBox(width: 8),
                      Text(
                        "Tanggal Lelang:",
                        style: TextStyle(
                          fontSize: 14,
                          color: Colors.grey.shade700,
                        ),
                      ),
                      const SizedBox(width: 8),
                      Text(
                        detailLelang['tgl_lelang'],
                        style: TextStyle(
                          fontSize: 15,
                          fontWeight: FontWeight.w600,
                          color: ColorHelper.fromHex('#1d2939'),
                        ),
                      ),
                    ],
                  ),
                  const SizedBox(height: 20),

                  Text(
                    "HARGA AKHIR",
                    style: TextStyle(
                      color: Colors.grey.shade600,
                      fontSize: 13,
                      fontWeight: FontWeight.w500,
                    ),
                  ),
                  const SizedBox(height: 4),
                  Text(
                    hargaAkhir,
                    style: TextStyle(
                      fontWeight: FontWeight.w800,
                      fontSize: 24,
                      color: ColorHelper.fromHex('#1d2939'),
                    ),
                  ),
                  const SizedBox(height: 12),

                  _buildInfoRow("Harga Awal", hargaAwal, Icons.sell_outlined),
                  const SizedBox(height: 8),

                  _buildInfoRow(
                    "Pemenang",
                    pemenang,
                    Icons.emoji_events_outlined,
                  ),

                  const SizedBox(height: 20),
                  const Divider(),
                  const SizedBox(height: 20),

                  Text(
                    "Deskripsi Barang",
                    style: TextStyle(
                      fontWeight: FontWeight.w600,
                      fontSize: 17,
                      color: ColorHelper.fromHex('#1d2939'),
                    ),
                  ),
                  const SizedBox(height: 10),
                  Text(
                    deskripsiBarang,
                    style: TextStyle(
                      fontSize: 14,
                      color: Colors.grey.shade800,
                      height: 1.5,
                    ),
                  ),

                  const SizedBox(height: 20),
                  const Divider(),
                  const SizedBox(height: 20),

                  Text(
                    "Riwayat Penawaran",
                    style: TextStyle(
                      fontWeight: FontWeight.w600,
                      fontSize: 17,
                      color: ColorHelper.fromHex('#1d2939'),
                    ),
                  ),
                  const SizedBox(height: 10),

                  _buildBidHistoryList(),
                ],
              ),
            ),
          ],
        ),
      ),
      bottomNavigationBar: null,
    );
  }

  Widget _buildInfoRow(String label, String value, IconData icon) {
    return Row(
      children: [
        Icon(icon, color: Colors.grey.shade700, size: 18),
        const SizedBox(width: 10),
        Text(
          "$label: ",
          style: TextStyle(fontSize: 14, color: Colors.grey.shade700),
        ),
        Expanded(
          child: Text(
            value,
            style: TextStyle(
              fontSize: 14,
              fontWeight: FontWeight.w600,
              color: Colors.grey.shade900,
            ),
            overflow: TextOverflow.ellipsis,
          ),
        ),
      ],
    );
  }

  Widget _buildBidHistoryList() {
    if (historiLelang.isEmpty) {
      return const Center(child: Text("Belum ada riwayat penawaran."));
    }
    final reversedList = historiLelang.reversed.toList();

    return Column(
      children: reversedList.asMap().entries.map((entry) {
        final int index = entry.key;
        final dynamic bid = entry.value;

        final bool isWinner = (index == 0);

        final FontWeight nameWeight = isWinner
            ? FontWeight.w700
            : FontWeight.w500;
        final FontWeight priceWeight = isWinner
            ? FontWeight.w700
            : FontWeight.w500;
        final Color priceColor = isWinner
            ? ColorHelper.fromHex('#465bff')
            : ColorHelper.fromHex('#1d2939');

        return Card(
          elevation: 0,
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(8),
            side: BorderSide(color: Colors.grey.shade200),
          ),
          margin: const EdgeInsets.symmetric(vertical: 4),
          child: ListTile(
            leading: CircleAvatar(
              backgroundColor: isWinner
                  ? ColorHelper.fromHex('#465bff').withOpacity(0.1)
                  : Colors.grey.shade100,
              child: Icon(
                isWinner ? Icons.emoji_events : Icons.person,
                color: isWinner
                    ? ColorHelper.fromHex('#465bff')
                    : Colors.grey.shade600,
              ),
            ),
            title: Text(
              bid['masyarakat']['nama_lengkap'],
              style: TextStyle(fontWeight: nameWeight),
            ),
            trailing: Text(
              CurrencyHelper.formatRupiah(bid['penawaran_harga']),
              style: TextStyle(
                fontWeight: priceWeight,
                color: priceColor,
                fontSize: 15,
              ),
            ),
          ),
        );
      }).toList(),
    );
  }
}
