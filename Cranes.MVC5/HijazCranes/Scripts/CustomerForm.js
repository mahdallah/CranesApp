$(document).ready(function () {
    // Vars
    var contactNoInput = $('#contact-input');
    var tbody = $("#customer-contacts-tbl #customer-contact-body");
    var removeButton = "<td><button type='button' class='btn btn-danger remove'><span class='change-icon-white ui-icon ui-icon-trash' ></span> Remove</button></td>";
    var updateButton = "<td><button type='button' class='btn btn-info update-btn'>Update</button></td>";
    var contactTableId = $('#customer-contacts-tbl');
    var addButton = $('#add-contact-btn');
    var contactIdInput = $('#contact-id');
    var CustomerId = $('#Customer_Id').val();
    var submitButton = $('#submit-btn');
    var contactTypeDropDownList = $("#customer-contact-contact-type");
    var defaultCheckBox = $('#CustomerContact_Default');
    // Data
    var Contacts = [];

    // Populate Customer Contacts
    async function GetCustomersContacts() {
        // /Customers/GetCustomerContact/
        data = await $.get('/Customers/GetCustomerContact/' + CustomerId);

        if (data.length == null) {
            toastr.info(data.message)
        }
        else {
            $.each(data, function (i, contact) {
                var contactTypeText = contact.ContactType == 0 ? "Mobile Number" : "Land Line";
                var contactDefaultClass = contact.Default == true ? "ui-icon-check" : "ui-icon-close";
                tbody.append(
                    "<tr class='contact-tr'><td class='populated-contact contact-no-td' contact-is-default='" + contact.Default + "' contact-type='" + contact.ContactType + "'>"
                    + contact.Contact + "</td><td>"
                    + contactTypeText + "</td><td class='is-default'><span class='ui-icon " + contactDefaultClass + "'></span></td>"
                    + updateButton
                    + removeButton +
                    "<td class='d-none contact-id-td'>" + contact.Id + "</td></tr>");
            });
            toastr.success("Added Successfully");

        }
    }
    GetCustomersContacts();

    // Remove the mobile no
    $(contactTableId).on("click", ".remove", function () {
        var tr = $(this).parents("tr")

        var td = tr.children(".contact-id-td").text()
        //if (td != 0) {
        //    ContactIds.push(td)
        //}
        tr.remove();
    });

    //Update Customer Contact
    $(contactTableId).on('click', '.update-btn', function () {
        var tr = $(this).parents('tr')

        var contact = tr.children(".contact-no-td").text();
        contactNoInput.val(contact);

        var contactIdTd = tr.children(".contact-id-td").text();
        contactIdInput.val(contactIdTd != 0 ? contactIdTd : 0);

        var contactType = tr.children(".contact-no-td").attr("contact-type")
        contactTypeDropDownList.val(contactType)

        var defaultContact = tr.children(".contact-no-td").attr("contact-is-default");

        if (defaultContact == "true") {
            defaultCheckBox.prop('checked', true);
            defaultCheckBox.val(true)
        }
        else {
            defaultCheckBox.prop('checked', false);
            defaultCheckBox.val(false)
        }

        addButton.text('Update');

        // disabling the update button in the table rows
        $('#customer-contacts-tbl tr').each(function () {
            $('.update-btn', this).attr('disabled', 'disabled')
        });
        tr.remove();
    });

    // Add contact
    $(addButton).click(function () {
        var isValid = true;
        // Validation
        if (!(contactNoInput.val().trim() != '' && (parseInt(contactNoInput.val()) || 0))) {
            isValid = false;
            toastr.error('make sure complete this feild or it is not zero')
            contactNoInput.val('')
        }
        if (contactTypeDropDownList.val() == 3) {
            isValid = false;
            toastr.error('select Contact Type')
            contactNoInput.val('')
        }

        if (isValid) {
            if (noDefault() == true && defaultCheckBox.is(':checked') == false) {
                toastr.error("Can't be added You should select Default Contact");
            }
            else {
                // vars
                var contactTypeText = contactTypeDropDownList.val() == 0 ? "Mobile Number" : "Land Line";
                var isChecked = defaultCheckBox.is(":checked");
                var contactId = contactIdInput.val();
                var contactDefaultText = isChecked == true ? "ui-icon-check" : "ui-icon-close";

                if (defaultCheckBox.is(':checked') == true) {
                    turnIntoFalse();
                }
                // changing button back
                addButton.html('<span class="ui-icon ui-icon-plusthick"></span>Add')
                // enabling the update button in the table rows
                $('#customer-contacts-tbl tr').each(function () {
                    $('.update-btn', this).removeAttr('disabled')
                });
                // Updated Contact
                if (contactIdInput.val() != 0) {
                    tbody.append(
                        "<tr class='contact-tr'><td class='contact-no-td updated' contact-is-default='" + isChecked + "' contact-type='" + contactTypeDropDownList.val() + "'>"
                        + contactNoInput.val() + "</td><td>"
                        + contactTypeText +
                        "</td><td class='is-default'><span class='ui-icon " + contactDefaultText + "'></span></td>"
                        + updateButton +
                        removeButton +
                        "<td class='d-none contact-id-td'>" + contactId + "</td></tr>");
                }
                else {
                    tbody.append(
                        "<tr class='contact-tr'><td class='contact-no-td new' contact-is-default='" + isChecked + "' contact-type='" + contactTypeDropDownList.val() + "'>"
                        + contactNoInput.val() + "</td><td>"
                        + contactTypeText +
                        "</td><td class='is-default'><span class='ui-icon " + contactDefaultText + "'></span></td>"
                        + updateButton +
                        removeButton +
                        "<td class='d-none contact-id-td'>" + contactId + "</td></tr>");
                }
                // clear the contactId from the input
                contactIdInput.val(0)
                // clearing the contact input
                contactNoInput.val('')
                // clear contact type
                contactTypeDropDownList.val(3)
                // uncheck default 
                defaultCheckBox.prop('checked', false);
                defaultCheckBox.val(false)
            }
        }
    });

    // Save Customer
    submitButton.click(function () {
        var isValid = true;
        
        var isThereContacts = $("#customer-contacts-tbl tr").length == 0;

        // Validate if there is No Contact
        if (isThereContacts) {
            toastr.error("You Should add Contact")
            isValid = false
        }
        if (noDefault() == true) {
            toastr.error('there is no default contact')
            isValid = false
        }
        // Check
        if (isValid) {

            // Retrive Contacts
            $("#customer-contacts-tbl .contact-tr").each(function () {
                // New
                var contact = $(this).children('.contact-no-td').text();
                var contactType = $(this).children('.contact-no-td').attr("contact-type");
                var contactId = $(this).children('.contact-id-td').text();
                var defaultContact = $(this).children('.contact-no-td').attr("contact-is-default");

                var CustomerContact = {
                    Contact: contact,
                    Id: contactId,
                    ContactType: contactType,
                    Default: defaultContact
                }
                Contacts.push(CustomerContact);
                
            });

            // Customer
            var Customer = {
                Id: CustomerId,
                FirstName: $('#Customer_FirstName').val(),
                LastName: $('#Customer_LastName').val()
            }

            var viewModel = {
                Customer,
                Contacts
            }

            // Save button style
            submitButton.attr("disabled", true);
            submitButton.html("Svaing to database");

            // Saving Customer Info
            // /Customers/SaveCustomer
            if (CustomerId == 0) {
                $.ajax({
                    method: 'POST',
                    url: '/Customers/Create',
                    data: JSON.stringify(viewModel),
                    contentType: 'application/json',
                    success: function (data) {
                        toastr.success(data.message)
                        submitButton.attr("disabled", false);
                        submitButton.text('Save');
                        // Redirect
                        window.location.replace("/customers/index");
                    }
                });
            }
            else {
                $.ajax({
                    method: 'POST',
                    url: '/Customers/Edit',
                    data: JSON.stringify(viewModel),
                    contentType: 'application/json',
                    success: function (data) {
                        toastr.success(data.message)
                        submitButton.attr("disabled", false);
                        submitButton.text('Save');
                        // Redirect
                        window.location.replace("/customers/index");
                    }
                });
            }
        }
    });

    // Functions
    // return bool of isThereDefautlContact
    function noDefault() {
        var con = true;
        $('.contact-tr').each(function () {
            var isDefault = $(this).children('.contact-no-td').attr('contact-is-default')
            if (isDefault == 'true') {

                con = false;
                // breack loop 
                return false;
            }
        });
        if (con) {
            return true
        }
        else {
            return false
        }
    }

    function turnIntoFalse() {
        $('#customer-contacts-tbl tr').each(function () {
            $('.contact-no-td', this).attr('contact-is-default', false)
            $('.contact-no-td', this).addClass('updated')
            $('.is-default', this).children('span').addClass('ui-icon-close')
            $('.is-default', this).children('span').removeClass('ui-icon-check')
        });
    }

    // console
    console.clear();
});