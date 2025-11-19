import 'package:flutter/material.dart';
import 'package:mobile/screens/login_screen.dart';

void main() {
  runApp(const KlikLelang());
}

class KlikLelang extends StatelessWidget {
  const KlikLelang({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Klik Lelang',
      theme: ThemeData(fontFamily: 'Poppins'),
      home: const LoginScreen(),
    );
  }
}
