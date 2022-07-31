'use strict';

{
  // トークンのデータを取得
  const token = document.querySelector('main').dataset.token;

  // input要素を取得
  const input = document.querySelector('[name="title"]');

  // ul様相を取得
  const ul = document.querySelector('ul');

  input.focus();

  ul.addEventListener('click', e => {
    // チャックボックスへのチェックに対する送信制御
    // チェックボックスをクリックしてもページを再読み込みしないように変更
    if (e.target.type === 'checkbox') {
      fetch('?action=toggle', {
        method: 'POST',
        body: new URLSearchParams({
          id: e.target.parentNode.dataset.id,
          token: token,
        }),
      })
      .then(response => {
        if(!response.ok) {
          throw new Error('This todo has been deleted!');
        }
      })
      .catch(err => {
        alert(err.message);
        location.reload();
      });
    }

    // リストタイトルの一括削除に対する送信制御
    if (e.target.classList.contains('delete')) {
      if (!confirm('Are you sure?')) {
        return;
      }
      fetch('?action=delete', {
        method: 'POST',
        body: new URLSearchParams({
          id: e.target.parentNode.dataset.id,
          token: token,
        }),
      });
      e.target.parentNode.remove();
    }
  });

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
}