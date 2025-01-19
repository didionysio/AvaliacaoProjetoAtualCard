<!DOCTYPE html>
<html>
<head>
    <title>Nova Consulta</title>
</head>
<body>
    <h1>Olá, {{ $consulta->paciente->nome }}</h1>
    <p>Uma nova consulta foi agendada para você:</p>
    <ul>
        <li><strong>Médico:</strong> {{ $consulta->medico->nome }}</li>
        <li><strong>Especialidade:</strong> {{ $consulta->medico->especialidade->nome }}</li>
        <li><strong>Data:</strong> {{ \Carbon\Carbon::parse($consulta->data_consulta)->format('d/m/Y H:i') }}</li>
    </ul>
    <p>Se tiver dúvidas, entre em contato conosco.</p>
</body>
</html>
