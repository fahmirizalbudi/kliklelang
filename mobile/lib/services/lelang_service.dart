import 'package:dio/dio.dart';
import 'package:flutter/rendering.dart';
import 'package:mobile/helpers/dio_client.dart';

class LelangService {
  Future<List<dynamic>> getLelang() async {
    try {
      final response = await DioClient.dio.get('/api/lelang');
      return response.data['data'];
    } catch (e) {
      return [];
    }
  }

  Future<bool> placeBid(int idLelang, int bid) async {
    try {
      final response = await DioClient.dio.post(
        '/api/lelang/$idLelang/bid',
        data: {'penawaran_harga': bid},
      );

      if (response.statusCode == 200) {
        return true;
      }

      return false;
    } on DioException catch (e) {
      debugPrint(e.toString());
      return false;
    }
  }

  Future<dynamic> getLelangDetail(int idLelang) async {
    try {
      final response = await DioClient.dio.get('/api/lelang/$idLelang/detail');
      return response.data['data'];
    } catch (e) {
      return [];
    }
  }

  Future<List<dynamic>> getLelangHistory() async {
    try {
      final response = await DioClient.dio.get('/api/lelang/history');
      return response.data['data'];
    } catch (e) {
      return [];
    }
  }
}
