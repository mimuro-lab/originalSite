<?php
function echoFormEdit(string $preTitle, string $preTag, string $preBody){
    echo '
    <form action=".?scene=preview" method="post">
    <table>
        <tr>
            <td>
            <div>
                <label for="title">記事のタイトル<br></label>
                <input type="text" id="title" name="title" value="'.$preTitle.'">
                </div>
                </td>
                <td>
                <div>
                    <label for="tag">タグ<br></label>
                    <input type="mail" id="tag" name="tag"  value="'.$preTag.'">
                </div>  
                </td>          
            </tr>
    
        </table>
        <div>
            <label for="body">記事の本文<br></label>
            <textarea id="body" name="body" rows="10" cols="60">'.$preBody.'</textarea>
            </div>
            <input type="submit" value="プレビュー画面へ">
        </form>'
    ;
}
?>