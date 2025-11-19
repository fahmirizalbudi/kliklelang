import 'package:dio/dio.dart';
import 'package:flutter/rendering.dart';
import 'package:mobile/helpers/dio_client.dart';

class AuthService {
  Future<bool> login(String username, String password) async {
    try {
      final response = await DioClient.dio.post(
        '/api/auth/login/masyarakat',
        data: {'username': username, 'password': password},
      );

      final data = response.data['data'];
      final token = data['token'];

      DioClient.initialize(token);
      return true;
    } on DioException catch (e) {
      debugPrint(e.error.toString());
      return false;
    }
  }
}
