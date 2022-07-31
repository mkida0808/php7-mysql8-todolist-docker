'use strict';

{
  // トークンのデータを取得
  const token = document.querySelector('main').dataset.token;

  // input要素を取得
  const input = document.querySelector('[name="title"]');

  input.focus();

  function addTodo(id, titleValue) {
    const li = document.createElement('li');
    li.dataset.id = id;

    const checkbox = document.createElement('input');
    checkbox.type = 'checkbox';

    const title = document.createElement('span');
    title.textContent = titleValue;

    const deleteSpan = document.createElement('span');
    deleteSpan.textContent = 'x';
    deleteSpan.classList.add('delete');

    li.appendChild(checkbox);
    li.appendChild(title);
    li.appendChild(deleteSpan);

    const ul = document.querySelector('ul');
    ul.insertBefore(li, ul.firstChild);
  }

  // formタグを取得してsubmitされたあとの処理
  document.querySelector('form').addEventListener('submit', e => {
    e.preventDefault();

    const title = input.value;

    fetch('?action=add', {
      method: 'POST',
      body: new URLSearchParams({
        title: title,
        token: token,
      }),
    })
    .then(response => response.json())
    .then(json => {
      addTodo(json.id, title);
    });
    input.value = '';
    input.focus();
  });

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
          id: checkbox.parentNode.dataset.id,
          token: token,
        }),
      };
      fetch(url, options);
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
      fetch('?action=delete', {
        method: 'POST',
        body: new URLSearchParams({
          id: span.parentNode.dataset.id,
          token: token,
        }),
      });
      span.parentNode.remove();
    });
  });

  // 一括削除要素を取得する
  const purge = document.querySelector('.purge');

  // リストタイトルの一括削除に対する送信制御
  purge.addEventListener('click', () => {
    if (!confirm('Are you sure?')) {
      return;
    }
    // purge.parentNode.submit();
    fetch('?action=purge', {
      method: 'POST',
      body: new URLSearchParams({
        token: token,
      }),
    });
    const lis = document.querySelectorAll('li');
    lis.forEach(li => {
      if (li.children[0].checked) li.remove();
    });
  });
}