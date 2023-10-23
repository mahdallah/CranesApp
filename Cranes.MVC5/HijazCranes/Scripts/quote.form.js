$(document).ready(function () {
    // vars
    // Quote
    var quoteIdInput = $("#Quote_Id");
    var employeeTxt = $("#Employee_FirstName");
    var employeeIdInput = $("#Employee_Id");
    var customersDropDwon = $("#Quote_Customer_Id");
    var totalInput = $("#Quote_Total");
    // Quote Cranes
    var quoteCranesTable = $("#quotecranes-tbl");
    var quoteCranestbdoy = $("#quotecranes-tbody");

    var removeBtn = "<td><button type='button' class='btn btn-danger remove'><span class='change-icon-white ui-icon ui-icon-trash' ></span>Remove</button></td>";
    var Idinput = $("#quoatecrane-id");
    var cranesDropDwon = $("#Cranes");
    var hoursInput = $("#QuoteCrane_HiredHours");
    var itemsInput = $("#QuoteCrane_HiredItems");
    var discountInput = $("#Quote_Discount");
    var priceInput = $("#QuoteCrane_Price");

    var hourRadioBtn = $("#is-for-hours");
    var itemsRadioBtn = $("#is-for-items");

    var addBtn = $("#add-btn");
    var submitBtn = $("#submit-btn");
    // Initial
    $(".customers").select2()
    GetQuoteCranes()
    hoursInput.hide();
    itemsInput.hide();
    var price = 0;

    // Workspace

    $("input[name='is-for-hours-items']").change(function () {
        ToggleInput()
        $('.hired').on('input', function () {
            Calculation();
        });
    });
    $('#Cranes').change(function () {
        clear();
        Calculation();
    })
    discountInput.on('input', function () {
        CalculateTotal();
        var total = parseInt(totalInput.val())
        var discount = discountInput.val() / 100
        if (discountInput.val() > 0 && discountInput.val() < 100) {
            var discountRate = total * parseFloat(discount)
            total = total - discountRate
            totalInput.val(total)
        }
    })

    // Add Button
    addBtn.click(function () {
        var isValid = true;
        // Crane
        if (cranesDropDwon.val() == '') {
            $("#Cranes").next().text("Select Crane")
            isValid = false
        }
        else {
            $("#Cranes").next().text("")
        }
        // Radio Button checked
        if (!$('input[name="is-for-hours-items"]').is(':checked')) {
            $("#div-for-items").next().text("Choose Hire Type")
            isValid = false
        }
        else {
            $("#div-for-items").next().text("")
        }
        // Hours
        if ($('input[name="is-for-hours-items"]:checked').val() == "hours") {
            if (hoursInput.val() == 0 || hoursInput.val() < 0) {
                hoursInput.next().text("Enter valid Number")
                isValid = false;
            }
            else if (hoursInput.val() < 4 && hoursInput.val() > 0) {
                hoursInput.next().text("Can't Hire less less than 4 hours")
                isValid = false;
            }
            else {
                hoursInput.next().text("")
            }
        }
        // Items
        if ($('input[name="is-for-hours-items"]:checked').val() == "items") {
            if (itemsInput.val() == 0 || itemsInput.val() < 0) {
                itemsInput.next().text("Enter valid Items")
                isValid = false;
            }
            else {
                itemsInput.next().text("")
            }
        }
        if (isValid) {
            var hour = $('input[name="is-for-hours-items"]:checked').val() == 'hours' ? hoursInput.val() : '';
            var items = $('input[name="is-for-hours-items"]:checked').val() == 'items' ? itemsInput.val() : '';
            quoteCranestbdoy.append(
                `<tr class='quotecrane-tr'>
                                            <td class='id-td' hidden>0</td>
                                            <td class='crane-id-td' value='` + cranesDropDwon.val() + `'>` + $('#Cranes option:selected').text() + `</td>
                                            <td class='hours-td'>`+ hour + `</td>
                                            <td class='items-td'>`+ items + `</td>
                                            <td class='price'>`+ priceInput.val() + `</td>
                                            `+ removeBtn + `
                                        </tr>`
            )
            CalculateTotal()
            cranesDropDwon.val('')
            clear();
        }
    });

    // Remove Button
    $(quoteCranesTable).on("click", ".remove", function () {
        var tr = $(this).parents("tr")

        //var td = tr.children(".contact-id-td").text()
        //if (td != 0) {
        //    ContactIds.push(td)
        //}
        tr.remove();
        CalculateTotal();
    });

    // Save Button
    submitBtn.click(function () {
        var isValid = true;
        // validation for quotes
        if (customersDropDwon.val() == '') {
            //customersDropDwon.next().text("Choose a Customer")
            toastr.error("Choose Customer Please")
            isValid = false
        }
        // validation for quoteCranes
        var isQuoteCranes = $("#quotecranes-tbody tr").length == 0;
        if (isQuoteCranes) {
            toastr.error("You Should add Quotation")
            isValid = false
        }
        if (discountInput.val() < 0 && discountInput.val() < 100) {
            discountInput.next().text("Use Real Numbers")
            isValid = false;
        }
        else {
            discountInput.next().text("")
        }
        if (isValid) {
            var Quote = {
                Id: quoteIdInput.val(),
                Customer_Id: customersDropDwon.val(),
                Employee_Id: employeeIdInput.val(),
                Discount: discountInput.val(),
                Total: totalInput.val()
            }
            var QuoteCranes = []
            var viewModel = {
                Quote: Quote,
                QuoteCranes: QuoteCranes
            }
            $('#quotecranes-tbody tr').each(function (i, tr) {
                var QuoteCrane = {
                    Id: $(this).children(".id-td").text(),
                    Quote_Id: quoteIdInput.val(),
                    Crane_Id: $(this).children(".crane-id-td").attr('value'),
                    HiredHours: $(this).children(".hours-td").text(),
                    HiredItems: $(this).children(".items-td").text(),
                    Price: $(this).children(".price").text()
                }
                QuoteCranes.push(QuoteCrane)
            });
            if (quoteIdInput.val() == 0) {
                $.ajax({
                    method: 'POST',
                    url: '/Quotes/Create',
                    data: viewModel,
                    success: function (data) {
                        if (data.success) {
                            toastr.success(data.message)
                            window.location.replace("/quotes/index");
                        }
                    },
                    error: function () {
                        toastr.error("Not Found URL")
                    }
                })
            }
            else {
                $.ajax({
                    method: 'POST',
                    url: '/Quotes/Edit',
                    data: viewModel,
                    success: function (data) {
                        if (data.success) {
                            toastr.success(data.message)
                            window.location.replace("/quotes/index");
                        }
                    },
                    error: function () {
                        toastr.error("Not Found URL")
                    }
                })
            }
        }
    })

    // functions
    function CalculateTotal() {
        var total = 0;
        $('.price').each(function () {
            total += parseInt($(this).text());
        })
        totalInput.val(total)
    }
    function clear() {
        hoursInput.val("")
        itemsInput.val("")
        priceInput.val(0)
        discountInput.val("")
    }
    async function GetQuoteCranes() {
        // /Quotes/GetQuoteCranes/
        data = await $.get('/Quotes/GetQuoteCranes/' + quoteIdInput.val());


        if (data.success == "true") {
            $.each(data.quoteCranes, function (i, quoteCrane) {
                var hours = quoteCrane.HiredHours != null ? quoteCrane.HiredHours : '';
                var Items = quoteCrane.HiredItems != null ? quoteCrane.HiredItems : '';
                quoteCranestbdoy.append(
                    `<tr class='quotecrane-tr populated'>
                                            <td class='id-td' hidden>` + quoteCrane.Id + `</td>
                                            <td class='crane-id-td' value='` + quoteCrane.Crane.Id + `'>` + quoteCrane.Crane.Name + `</td>
                                            <td class='hours-td'>`+ hours + `</td>
                                            <td class='items-td'>`+ Items + `</td>
                                            <td class='price'>`+ quoteCrane.Price + `</td>
                                            `+ removeBtn + `
                                        </tr>`
                )
            });
        }
    }
    function Calculation() {
        if (cranesDropDwon.val() != '' && $('input[name="is-for-hours-items"]').is(":checked")) {
            GetPrice(cranesDropDwon.val(), $('input[name="is-for-hours-items"]:checked').val())
            var actualPrice = 0;
            if ($('input[name="is-for-hours-items"]:checked').val() == 'hours') { actualPrice = hoursInput.val() * price; }
            if ($('input[name="is-for-hours-items"]:checked').val() == 'items') { actualPrice = itemsInput.val() * price; }
            if (actualPrice > 0) {
                priceInput.val(Math.round(actualPrice))
            }
        }
        else {
            priceInput.val(0)
        }
    }
    function GetPrice(id, priceType) {
        // Quotes/GetPrice?id=5&priceType=Hours
        $.ajax({
            method: "GET",
            url: "/quotes/GetPrice?id=" + id + "&priceType=" + priceType,
            success: function (data) {
                price = data.price
            }
        })
    }
    function ToggleInput() {
        if ($('input[name="is-for-hours-items"]:checked').val() == 'hours') {
            hoursInput.show();
            itemsInput.hide();
            cranesDropDwon.val('')
            clear();
        }
        if ($('input[name="is-for-hours-items"]:checked').val() == 'items') {
            hoursInput.hide();
            itemsInput.show();
            cranesDropDwon.val('')
            clear();
        }
    }
})