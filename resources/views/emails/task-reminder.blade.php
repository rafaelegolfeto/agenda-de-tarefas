<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lembrete de Tarefa</title>
</head>
<body>
    <h1>Lembrete de Tarefa</h1>
    <p>Olá,</p>
    <p>Lembramos que você tem uma tarefa pendente:</p>
    <ul>
        <li>Título: {{ $task->title }}</li>
        <li>Descrição: {{ $task->description }}</li>
        <li>Data de Vencimento: {{ $task->due_date }}</li>
    </ul>
    <p>Por favor, finalize a tarefa o mais breve possível.</p>
    <p>Atenciosamente,</p>
    <p>A equipe do seu aplicativo</p>
</body>
</html>
