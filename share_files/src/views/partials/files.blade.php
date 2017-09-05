@if(isset($files))
<table>
        <tr v-for='file in shownFiles'>
            <td>
                <a href="/file/@{{ file.slug }}">@{{ file.name }}</a>
                <p>@{{ file.description.slice(0, 200) }}...</p>
            </td>
        </tr>
</table>
@endif

