class Session {
  static String? _accessToken;

  static setAccessToken(String token) {
    _accessToken = token;
  }

  static getAccessToken() {
    return _accessToken;
  }
}
