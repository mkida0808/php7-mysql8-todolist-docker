'use strict';

{
  // 全てのチェックボックスを取得
  const checkboxes = document.querySelectorAll('input[type="checkbox"]');

  // チャックボックスへのチェックに対する送信制御
  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', () => {
      // checkbox.parentNode.submit();

      // チェックボックスをクリックしてもページを再読み込みしないように変更
      const url = '?action=toggle';
      const options = {
        method: 'POST',
        body: new URLSearchParams({
          id: checkbox.dataset.id,
          token: checkbox.dataset.token,
        }),
      };
      fetch(url, options);
      checkbox.nextElementSibling.classList.toggle('done');
    });
  });

  // 全ての削除要素を取得する
  const deletes = document.querySelectorAll('.delete');

  // リストタイトルの削除に対する送信制御
  deletes.forEach(span => {
    span.addEventListener('click', () => {
      if (!confirm('Are you sure?')) {
        return;
      }
      span.parentNode.submit();
    });
  });

  // 一括削除要素を取得する
  const purge = document.querySelector('.purge');

  // リストタイトルの一括削除に対する送信制御
  purge.addEventListener('click', () => {
    if (!confirm('Are you sure?')) {
      return;
    }
    purge.parentNode.submit();
  });
}