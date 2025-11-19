import 'package:flutter/material.dart';

class ColorHelper {
  static Color fromHex(String hex) {
    hex = hex.replaceAll('#', '');

    if (hex.length == 6) {
      hex = 'FF$hex';
    }

    return Color(int.parse(hex, radix: 16));
  }
}
