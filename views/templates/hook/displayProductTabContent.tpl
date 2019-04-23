<h3 class="page-product-heading">
    Les commentaires sur le produit
</h3>

<div class="rte">
  {foreach from=$comments item=comment}
    <p>
        <strong>Commentaire #{$comment.id_mymod_comment}:</strong>
        {$comment.comment}
        <br>
        <strong>Note:</strong> {$comment.grade}/5
        <br>
    </p>
    <br>
  {/foreach}
</div>


<div class="rte">
    <form action="" method="POST" id="comment-form">
        <div class="form-group">
            <label for="grade">Note:</label>
            <div class="row">
                <div class="col-xs-4">
                    <select id="grade" class="form-control" name="grade">
                        <option value="0">-- Choississez --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
           <label for="comment">Commentaire:</label>
           <textarea name="comment" id="comment" class="form-control"></textarea>
        </div>

        <div class="submit">
            <button type="submit" name="mymod_pc_submit_comment" class="button btw btn-default button-medium">
                <span>Envoyer
                    <i class="icon-chevron-right right"></i>
                </span>
            </button>
       </div>

    </form>

</div>

