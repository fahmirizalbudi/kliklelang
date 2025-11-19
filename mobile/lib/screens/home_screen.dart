import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';
import 'package:mobile/helpers/color_helper.dart';
import 'package:mobile/helpers/currency_helper.dart';
import 'package:mobile/services/lelang_service.dart';
import 'package:mobile/widgets/auction_card_widget.dart';
import 'package:mobile/widgets/edittext_widget.dart';

class HomeScreen extends StatelessWidget {
  const HomeScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      appBar: AppBar(
        scrolledUnderElevation: 0,
        toolbarHeight: 85,
        backgroundColor: Colors.white,
        elevation: 0,
        title: Row(
          children: [
            Container(
              clipBehavior: Clip.hardEdge,
              decoration: BoxDecoration(
                borderRadius: BorderRadius.circular(10),
              ),
              child: SvgPicture.asset(
                'assets/icons/brand.svg',
                width: 45,
                height: 45,
                fit: BoxFit.cover,
              ),
            ),
            const SizedBox(width: 12.5),
            Text(
              "KlikLelang",
              style: TextStyle(
                fontWeight: FontWeight.w600,
                fontSize: 20,
                color: ColorHelper.fromHex('#1d2939'),
              ),
            ),
          ],
        ),
        actions: [
          IconButton(
            icon: const Icon(Icons.more_vert, size: 22),
            onPressed: () {},
            color: Colors.black87,
          ),
        ],
      ),

      body: SingleChildScrollView(
        child: Padding(
          padding: EdgeInsets.symmetric(vertical: 4, horizontal: 16),
          child: Column(
            children: [
              EditText(
                leftIcon: Icon(Icons.search_rounded, size: 25),
                placeholder: 'Cari barang atau lelang',
                controller: TextEditingController(),
              ),

              const SizedBox(height: 20),

              FutureBuilder<List<dynamic>>(
                future: LelangService().getLelang(),
                builder: (context, snapshot) {
                  if (snapshot.connectionState == ConnectionState.waiting) {
                    return Center(child: CircularProgressIndicator());
                  }

                  if (!snapshot.hasData || snapshot.data!.isEmpty) {
                    return Center(child: Text('Tidak ada data'));
                  }

                  final list = snapshot.data!;

                  return ListView.builder(
                    shrinkWrap: true,
                    physics: NeverScrollableScrollPhysics(),
                    itemCount: list.length,
                    itemBuilder: (context, index) {
                      final lelang = list[index];
                      final history = lelang['history_lelang'] as List<dynamic>;
                      final highestBidValue = history.isNotEmpty
                          ? history
                                .map((h) => h['penawaran_harga'] as int)
                                .reduce((a, b) => a > b ? a : b)
                          : null;

                      return Column(
                        children: [
                          AuctionCard(
                            bidHistoryList: history,
                            idLelang: lelang['id_lelang'],
                            imageUrl:
                                'http://192.168.43.205:8000/storage/foto_barang/${lelang['barang']['foto_barang']}',
                            itemName: lelang['barang']['nama_barang'],
                            startingPrice: CurrencyHelper.formatRupiah(
                              lelang['barang']['harga_awal'],
                            ),
                            highestBid: highestBidValue != null
                                ? CurrencyHelper.formatRupiah(highestBidValue)
                                : "-",
                            highestBidderName: lelang['masyarakat'] != null
                                ? lelang['masyarakat']['nama_lengkap']
                                : "-",
                          ),
                          SizedBox(height: 16),
                        ],
                      );
                    },
                  );
                },
              ),
            ],
          ),
        ),
      ),
    );
  }
}
