<form action=".?scene=preview" method="post">
    <input type="hidden" name="index" value="<?php if(isset($_POST["index"])){echo $_POST["index"];}?>">
    <table>
        <tr>
            <td>
            <div>
                <label for="title">記事のタイトル<br></label>
                <input type="text" id="title" name="title" value="<?php if(isset($_POST["title"])){echo $_POST["title"];}?>">
            </div>
            </td>
            <td>
            <div>
                <label for="tag">タグ<br></label>
                <input type="mail" id="tag" name="tag"  value="<?php if(isset($_POST["tag"])){echo $_POST["tag"];}?>">
            </div>  
            </td>          
        </tr>

    </table>
    <div>
        <label for="body">記事の本文<br></label>
        <textarea id="body" name="body" rows="10" cols="60"><?php if(isset($_POST["body"])){echo $_POST["body"];}?></textarea>
    </div>
    <input type="submit" value="プレビュー画面へ">
</form>