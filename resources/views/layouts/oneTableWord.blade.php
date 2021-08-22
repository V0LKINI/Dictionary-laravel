<tr class="tableRow" id="tableRow-{{ $word->id }}">
    <td class="tableColumn">{{ $word->english }}</td>
    <td class="tableColumn">{{ $word->russian }}</td>
    <td class="tableColumn">
        <span class="penIcon material-icons" onclick="edit({{ $word->id }})">edit</span>
        <span class="binIcon material-icons" onclick="deleteWord({{ $word->id }})">delete</span>
        <span class="resetIcon material-icons" onclick="resetWordProgress({{ $word->id }})">cached</span>
    </td>
    <td class="tableColumn" id="wordProgress">0%</td>
</tr>
