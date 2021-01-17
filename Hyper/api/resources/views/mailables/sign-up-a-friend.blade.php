<h1>Signed up by:</h1>
<p>{{$friendModel->getUser()->getFirstName() .' '. $friendModel->getUser()->getLastName()}}</p>
<p> I want to signup my friend this are his contact information </p>

<table>
    <tr>
        <th>Name</th>
        <th>Age</th>
        <th>Phone</th>
        <th>Location</th>
    </tr>
    <tr>
        <td>{{$friendModel->getName()}}</td>
        <td>{{$friendModel->getAge()}}</td>
        <td>{{$friendModel->getPhone()}}</td>
        <td>{{$friendModel->getLocation()}}</td>
    </tr>
</table>
