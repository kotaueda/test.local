<!-- flatpickrスクリプトを読み込む -->
<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
<!-- 日本語化するためのスクリプト追加する -->
<script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>

<!-- getElementByIdは任意のHTMLタグで指定した引数にマッチするドキュメント要素を取得するメソッド -->
<!-- minDateオプションで本日の日付より若い日付を入力できないようにする -->
<script>
  flatpickr(document.getElementById('due_date'), {
    locale: 'ja',
    dateFormat: "Y/m/d",
    minDate: new Date()
  });
</script>