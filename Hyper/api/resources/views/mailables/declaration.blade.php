<h1>Declaratie:</h1>

<p>
    Medewerker met ID: {{$declarationModel->getUser()->getId()}}
    heeft zo juist een declaratie ingediend.
</p>
<table class="table">
    <tr>
        <th>Declaratie soort</th>
        <th>'datum_van_indienen'</th>
        <th>locatie</th>
        <th>bedrag exc btw</th>
        <th>btw</th>
    </tr>
    <tr>
        <td>{{$declarationModel->getDeclarationType()}}</td>
        <td>{{$declarationModel->getDateOfSubmission()}}</td>
        <td>{{$declarationModel->getLocation()}}</td>
        <td>{{$declarationModel->getAmountExcVat()}}</td>
        <td>{{$declarationModel->getVat()}}</td>
    </tr>
</table>

