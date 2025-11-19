import 'package:dio/dio.dart';
import 'package:flutter/material.dart';

class DioClient {
  static final Dio dio = Dio(
    BaseOptions(
      baseUrl: 'http://10.0.2.2:8000',
      connectTimeout: const Duration(seconds: 10),
      receiveTimeout: const Duration(seconds: 10),
      contentType: 'application/json',
    ),
  );

  static void initialize(String? token) {
    dio.interceptors.clear();

    dio.interceptors.add(
      InterceptorsWrapper(
        onRequest: (options, handler) {
          if (token != null) {
            options.headers['Authorization'] = 'Bearer $token';
          }
          debugPrint('[REQUEST] ${options.method} ${options.uri}');
          return handler.next(options);
        },
        onResponse: (response, handler) {
          debugPrint('[RESPONSE] ${response.statusCode} ${response.data}');
          return handler.next(response);
        },
        onError: (e, handler) {
          debugPrint('[ERROR] ${e.response?.statusCode} ${e.response?.data}');
          return handler.next(e);
        },
      ),
    );
  }

  static Future<Response> get(
    String path, {
    Map<String, dynamic>? query,
  }) async {
    return await dio.get(path, queryParameters: query);
  }

  static Future<Response> post(String path, {dynamic data}) async {
    return await dio.post(path, data: data);
  }

  static Future<Response> put(String path, {dynamic data}) async {
    return await dio.put(path, data: data);
  }

  static Future<Response> delete(String path) async {
    return await dio.delete(path);
  }
}
