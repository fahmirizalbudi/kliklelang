import 'package:flutter/material.dart';
import 'package:mobile/helpers/color_helper.dart';

class EditText extends StatelessWidget {
  final String placeholder;
  final bool isPassword;
  final TextEditingController controller;
  final Icon? leftIcon;

  const EditText({
    super.key,
    required this.placeholder,
    this.isPassword = false,
    required this.controller,
    this.leftIcon,
  });

  @override
  Widget build(BuildContext context) {
    return TextField(
      controller: controller,
      obscureText: isPassword,
      style: TextStyle(fontSize: 16),
      decoration: InputDecoration(
        contentPadding: EdgeInsets.symmetric(horizontal: 16, vertical: 17),

        prefixIcon: Padding(
          padding: const EdgeInsets.only(left: 9),
          child: leftIcon,
        ),
        prefixIconColor: ColorHelper.fromHex('#727272'),

        hintText: placeholder,
        hintStyle: TextStyle(
          color: ColorHelper.fromHex('727272'),
          fontSize: 16,
        ),

        enabledBorder: OutlineInputBorder(
          borderRadius: BorderRadius.circular(8),
          borderSide: BorderSide(
            color: ColorHelper.fromHex('#e0e0e0'),
            width: 1.5,
          ),
        ),

        focusedBorder: OutlineInputBorder(
          borderRadius: BorderRadius.circular(8),
          borderSide: BorderSide(
            color: ColorHelper.fromHex('#e0e0e0'),
            width: 1.5,
          ),
        ),

        border: OutlineInputBorder(
          borderRadius: BorderRadius.circular(8),
          borderSide: BorderSide(
            color: ColorHelper.fromHex('#e0e0e0'),
            width: 1.5,
          ),
        ),
      ),
    );
  }
}
