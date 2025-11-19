import 'package:flutter/material.dart';
import 'package:mobile/helpers/color_helper.dart';
import 'package:mobile/helpers/toast_helper.dart';
import 'package:mobile/services/auth_service.dart';
import 'package:mobile/widgets/edittext_widget.dart';
import 'package:flutter_svg/flutter_svg.dart';

class LoginScreen extends StatefulWidget {
  const LoginScreen({super.key});

  @override
  State<LoginScreen> createState() => _LoginScreenState();
}

class _LoginScreenState extends State<LoginScreen> {
  final TextEditingController usernameController = TextEditingController();
  final TextEditingController passwordController = TextEditingController();

  @override
  void dispose() {
    usernameController.dispose();
    passwordController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Center(
        child: Padding(
          padding: const EdgeInsets.symmetric(horizontal: 20),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Container(
                clipBehavior: Clip.hardEdge,
                decoration: BoxDecoration(
                  borderRadius: BorderRadius.circular(10),
                ),
                child: SvgPicture.asset(
                  'assets/icons/brand.svg',
                  width: 60,
                  height: 60,
                  fit: BoxFit.cover,
                ),
              ),

              SizedBox(height: 24),

              Text(
                "Welcome di KlikLelang!",
                style: TextStyle(
                  fontWeight: FontWeight.w500,
                  fontSize: 24,
                  color: ColorHelper.fromHex("#1d2939"),
                ),
              ),
              SizedBox(height: 8),
              Text(
                'Silahkan Log In untuk melakukan lelang.',
                style: TextStyle(
                  fontSize: 16,
                  color: ColorHelper.fromHex('#7b7b7b'),
                ),
              ),
              SizedBox(height: 48),
              EditText(placeholder: 'Username', controller: usernameController),
              SizedBox(height: 16),
              EditText(
                placeholder: 'Password',
                isPassword: true,
                controller: passwordController,
              ),
              SizedBox(height: 32),
              SizedBox(
                width: double.infinity,
                child: ElevatedButton(
                  onPressed: () async {
                    String username = usernameController.text;
                    String password = passwordController.text;

                    final ok = await AuthService().login(username, password);
                    if (ok) {
                      ToastHelper.show('Login Skses');
                      return;
                    }
                    ToastHelper.show('msg');
                  },
                  style: ElevatedButton.styleFrom(
                    backgroundColor: ColorHelper.fromHex('#465bff'),
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(8),
                    ),
                    padding: EdgeInsets.symmetric(horizontal: 40, vertical: 17),
                  ),
                  child: Text(
                    "Log In",
                    style: TextStyle(color: Colors.white, fontSize: 16),
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
