<?php

namespace MyApp;

class todo
{
  private $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
    Token::create();
  }

  public function processPost()
  {
    // Todoリスト一覧にタイトルを追加関数、または既存タイトルの更新処理を呼び出す
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
      Token::validate();
      $action = filter_input(INPUT_GET, 'action');

      switch ($action) {
        case 'add':
          $id = $this->add();
          header('Content-Type: application/json');
          echo json_encode(['id' => $id]);
          break;
        case 'toggle':
          $this->toggle();
          break;
        case 'delete':
          $this->delete();
          break;
        case 'purge':
          $this->purge();
          break;
        default:
          exit;
      }

      // 再読み込みの際にpostされないようにトップにリダイレクトする
      // SITE_URLはSERVER変数から取得する
      // header('Location: SITE_URL');
      exit;
    }
  }

  // Todoリスト一覧のタイトル更新処理
  private function toggle()
  {
    $id = filter_input(INPUT_POST, 'id');
    if (empty($id)) return;

    $stmt = $this->pdo->prepare("UPDATE todos SET is_done = NOT is_done WHERE id = :id");
    $stmt->bindValue('id', $id, \PDO::PARAM_INT);
    $stmt->execute();
  }

  // Todoリスト一覧のタイトル削除処理
  private function delete()
  {
    $id = filter_input(INPUT_POST, 'id');
    if (empty($id)) return;

    $stmt = $this->pdo->prepare("DELETE FROM todos WHERE id = :id");
    $stmt->bindValue('id', $id, \PDO::PARAM_INT);
    $stmt->execute();
  }

  // Todoリスト一覧に新規レコードを追加
  private function add()
  {
    // 入力フォームから入力タイトルを取得する
    $title = trim(filter_input(INPUT_POST, 'title'));
    if ($title === '') return;

    $stmt = $this->pdo->prepare("INSERT INTO todos (title) VALUES (:title)");
    $stmt->bindValue('title', $title, \PDO::PARAM_STR);
    $stmt->execute();

    return (int) $this->pdo->lastInsertId();
  }

  // Todoリスト一覧の一括削除処理（チェックボックスにチェックがあるリスト）
  private function purge()
  {
    $this->pdo->query("DELETE FROM todos WHERE is_done = 1");
  }

  // Todoリスト一覧を取得
  public function getAll()
  {
    $stmt = $this->pdo->query("select * from todos order by id desc");
    $todos = $stmt->fetchAll();
    return $todos;
  }
}
