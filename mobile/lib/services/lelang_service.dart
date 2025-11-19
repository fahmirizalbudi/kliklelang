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
}
