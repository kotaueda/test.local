<!-- メールの本文のテンプレートを作成 -->
<a href="{{ route('password.reset', ['token' => $token]) }}">
  パスワード再設定リンク
</a>