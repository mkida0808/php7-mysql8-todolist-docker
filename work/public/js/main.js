'use strict';

{
  // 全てのチェックボックスを取得
  const checkboxes = document.querySelectorAll('input[type="checkbox"]');

  // チャックボックスへのチェックに対する送信制御
  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', () => {
      checkbox.parentNode.submit();
    });
  });

  // 全ての削除要素を取得する
  const deletes = document.querySelectorAll('.delete');

  // リストタイトルの削除に対する送信制御
  deletes.forEach(span => {
    span.addEventListener('click', () => {
      span.parentNode.submit();
    });
  });
}