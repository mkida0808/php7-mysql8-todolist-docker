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
}