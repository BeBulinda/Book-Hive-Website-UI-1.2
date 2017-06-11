<form role="form">
    <div class="">
        <div class="btn-group btn-group-sm" role="group">
            <input type="button" class="btn btn-secondary btn-danger" onclick="decrementValue()" value="-" />
            <input type="text" class="btn btn-secondary" name="quantity" value="1" maxlength="2" max="10" size="1" id="number" readonly="" />
            <input type="button" class="btn btn-secondary btn-info" onclick="incrementValue()" value="+" />
        </div>
        <input type="submit" class="btn btn-secondary btn-success addcart" value="Add to Cart" />
    </div>
</form>