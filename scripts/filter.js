
/**
 * collects parameters (name and price) from .catalog-item div
 * @param div
 * @returns {{title: (*|jQuery), price: Number}}
 */
function getProductParametersFromDOM(div) {
    var name = $('.name', div).html();
    var price = parseInt($('.price', div).html());
    var power_type = $('.power-type', div).html().toLowerCase();

    var item = {
        title: name,
        price: price,
        power: power_type

    };
    return item;
}




/**
 * collects parameters from the form filled by the user - min and max price and selected companies
 * @returns {{minPrice: Number, maxPrice: Number, companies: Array}}
 */
function getProductParametersFromForm() {

    var form = $('#priceFilterForm');
    var x = $(".tooltip-inner");
    var values = x.html();
    // console.log(values)
    var numberPattern = /\d+/g;
    var numbers = values.match(numberPattern);
    // console.log(numbers);
    var minPrice = numbers['0'];
    var maxPrice = numbers['1'];
    // console.log(minPrice);
    // console.log(maxPrice);
    // var minPrice = parseInt($('.price-min', form).val());
    // var maxPrice = parseInt($('.price-max', form).val());
    var radioButtonValue = $('input[type=radio]:checked').val();
    var companies = [];
    $('input[type=checkbox]:checked', form).each(function () {
        companies.push($(this).val());
    });
    var formParams = {
        minPrice: minPrice,
        maxPrice: maxPrice,
        companies: companies,
        power: radioButtonValue
    };

    return formParams;
}

/**
 * receives two parameters, string and array of strings.
 * loops through the array and checks if one or more of array values is a substring of the string
 * @param str
 * @param arr
 * @returns {boolean}
 */
function isSubstringFound (str, arr) {
    var foundAtLeastOnce = false;
    for (var i=0; i<arr.length; i++) {

        if(str.indexOf(arr[i]) != -1) {
            foundAtLeastOnce = true;
        }
    }
    return foundAtLeastOnce;
}


/**
 * checks if the product (.catalog-item div) fits for the parameters set in form
 * @param formParams
 * @param productParams
 * @returns {boolean}
 */
function isProductMatched(formParams, productParams) {
    //array with the names of companies taken from the form
    var companiesSelectedInForm = formParams.companies;

    //min price taken from the form
    var minPriceSelectedInForm = formParams.minPrice;

    //max price taken from the form
    var maxPriceSelectedInForm = formParams.maxPrice;

    //product name taken from one of .catalog-item divs
    var productCompany = productParams.title.toLocaleLowerCase();

    //product price taken from one of .catalog-item divs
    var productPrice = productParams.price;

    //power-type taken from product
    var productPowerType = productParams.power;


    //power value taken from form
    var powerValSelectedInForm = formParams.power;

    var productMatched = true;

    //check if the user selected any checkboxes
    // and if there is a match between on of selected companies and product name
    if (companiesSelectedInForm.length > 0 && !isSubstringFound(productCompany, companiesSelectedInForm)) {
        productMatched = false;
    }

    //check if product price is within required range of prices
    if (productPrice < minPriceSelectedInForm || productPrice > maxPriceSelectedInForm) {
        productMatched = false;
    }

    //check if product power-type matched with power selected in radio button
    if (powerValSelectedInForm !== productPowerType) {
        productMatched = false;

    }

    return productMatched;


}


$(document).ready(function () {
    $("#ex2").slider({}); // Bootstrap slider init
    $('#priceFilterForm').on('submit', function(e) {
        e.preventDefault();
        var products =  $('.catalog-item');
        products.hide();

        var formParams = getProductParametersFromForm();
        products.each(function() {
            var productParams = getProductParametersFromDOM(this);
            if(isProductMatched(formParams, productParams)) {
                $(this).show();
            }
        })
    });



});






