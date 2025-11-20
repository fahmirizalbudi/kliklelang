import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';
import 'package:mobile/helpers/color_helper.dart';
import 'package:mobile/helpers/currency_helper.dart';
import 'package:mobile/helpers/url_helper.dart';
import 'package:mobile/screens/history_detail_screen.dart';
import 'package:mobile/services/lelang_service.dart';
import 'package:mobile/widgets/edittext_widget.dart';
import 'package:mobile/widgets/history_card_widget.dart';

class HistoryScreen extends StatefulWidget {
  const HistoryScreen({super.key});

  @override
  State<HistoryScreen> createState() => _HistoryScreenState();
}

class _HistoryScreenState extends State<HistoryScreen> {
  String selectedStatus = 'semua';
  String searchQuery = '';
  late Future<List<dynamic>> historyFuture;
  final TextEditingController searchController = TextEditingController();

  @override
  void initState() {
    super.initState();
    historyFuture = LelangService().getLelangHistory();

    searchController.addListener(() {
      setState(() {
        searchQuery = searchController.text.toLowerCase();
      });
    });
  }

  @override
  void dispose() {
    searchController.dispose();
    super.dispose();
  }

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
                placeholder: 'Cari histori barang atau lelang',
                controller: searchController,
              ),

              const SizedBox(height: 20),

              _buildFilterTabs(),

              const SizedBox(height: 20),

              FutureBuilder<List<dynamic>>(
                future: historyFuture,
                builder: (context, snapshot) {
                  if (snapshot.connectionState == ConnectionState.waiting) {
                    return Center(child: CircularProgressIndicator());
                  }

                  if (!snapshot.hasData || snapshot.data!.isEmpty) {
                    return Center(child: Text('Tidak ada data histori'));
                  }

                  final list = snapshot.data!;

                  final List<dynamic> statusFilteredList;
                  if (selectedStatus == 'semua') {
                    statusFilteredList = list;
                  } else {
                    statusFilteredList = list
                        .where(
                          (item) => item['status_lelang'] == selectedStatus,
                        )
                        .toList();
                  }

                  final List<dynamic> finalFilteredList;
                  if (searchQuery.isEmpty) {
                    finalFilteredList = statusFilteredList;
                  } else {
                    finalFilteredList = statusFilteredList
                        .where(
                          (item) => item['barang']['nama_barang']
                              .toLowerCase()
                              .contains(searchQuery),
                        )
                        .toList();
                  }

                  if (finalFilteredList.isEmpty) {
                    return Center(child: Text('Tidak ada data yang cocok'));
                  }

                  return ListView.builder(
                    shrinkWrap: true,
                    physics: NeverScrollableScrollPhysics(),
                    itemCount: finalFilteredList.length,
                    itemBuilder: (context, index) {
                      final historyLelang = finalFilteredList[index];
                      final idLelang = historyLelang['id_lelang'];
                      final statusLelang =
                          historyLelang['status_lelang'] == 'menang'
                          ? HistoryStatus.menang
                          : historyLelang['status_lelang'] == 'kalah'
                          ? HistoryStatus.kalah
                          : HistoryStatus.berjalan;

                      return Column(
                        children: [
                          HistoryCard(
                            gambar:
                                '${UrlHelper.getBaseUrl()}:8000/storage/foto_barang/${historyLelang['barang']['foto_barang']}',
                            namaBarang: historyLelang['barang']['nama_barang'],
                            status: statusLelang,
                            valueHargaSatu: CurrencyHelper.formatRupiah(
                              historyLelang['barang']['harga_awal'],
                            ),
                            valueHargaDua: historyLelang['harga_akhir'] != null
                                ? CurrencyHelper.formatRupiah(
                                    historyLelang['harga_akhir'],
                                  )
                                : '-',
                            onTap: () {
                              Navigator.push(
                                context,
                                MaterialPageRoute(
                                  builder: (context) =>
                                      HistoryDetailScreen(idLelang: idLelang),
                                ),
                              );
                            },
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

  Widget _buildFilterTabs() {
    return SingleChildScrollView(
      scrollDirection: Axis.horizontal,
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          _buildFilterChip('semua', 'Semua'),
          _buildFilterChip('menang', 'Menang'),
          _buildFilterChip('proses', 'Berjalan'),
          _buildFilterChip('kalah', 'Kalah'),
        ],
      ),
    );
  }

  Widget _buildFilterChip(String status, String label) {
    final bool isActive = selectedStatus == status;
    final Color activeColor = ColorHelper.fromHex('#465bff');
    final Color inactiveColor = Colors.grey.shade600;

    return GestureDetector(
      onTap: () {
        setState(() {
          selectedStatus = status;
        });
      },
      child: Container(
        margin: const EdgeInsets.only(right: 8.0),
        padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
        decoration: BoxDecoration(
          color: isActive ? activeColor : Colors.white,
          borderRadius: BorderRadius.circular(20),
          border: Border.all(
            color: isActive ? activeColor : Colors.grey.shade400,
          ),
        ),
        child: Text(
          label,
          style: TextStyle(
            color: isActive ? Colors.white : inactiveColor,
            fontWeight: FontWeight.w600,
          ),
        ),
      ),
    );
  }
}
