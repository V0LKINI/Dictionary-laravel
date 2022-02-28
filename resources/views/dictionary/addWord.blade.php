<tr class="tableRow" id="tableRow-{{ $word->id }}">
    <td class="tableColumn">{{ $word->english }}</td>
    <td class="tableColumn">{{ $word->russian }}</td>
    <td class="tableColumn">
        <span class="penIcon material-icons">edit</span>
        <span class="binIcon material-icons">delete</span>
        <span class="resetIcon material-icons">cached</span>
    </td>
    <td class="tableColumn" id="wordProgress">0%</td>
</tr>