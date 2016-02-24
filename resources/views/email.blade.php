<html>
<head>
    <style>
        table {
            border-collapse: collapse;
            border: 1px black;
        }
        td {
            width: 40px
        }
    </style>
</head>
<body>
<table border="1">
    @foreach($options as $k => $v)
<tr>
        @foreach ($v as $key => $value)
            <td> {{ $value }}</td>
        @endforeach
</tr>
    @endforeach
</table>

</body>
</html>