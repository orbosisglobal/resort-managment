"use strict";
var KTAppInvoicesCreate = function () {
    var e;

    return {
        init: function () {
            e = document.querySelector("#kt_invoice_form2");

            // Add item button
            e.querySelector('[data-kt-element="add-item"]').addEventListener("click", function (n) {
                n.preventDefault();
                var row = e.querySelector('[data-kt-element="item-template"] tr').cloneNode(true);
                document.querySelector("#kt_invoice_form").querySelector('[data-kt-element="items"] tbody').appendChild(row);
                calculateTotals();
            });

            // Remove item
            KTUtil.on(document.querySelector("#kt_invoice_form"), '[data-kt-element="remove-item"]', "click", function (e) {
                e.preventDefault();
                KTUtil.remove(this.closest('[data-kt-element="item"]'));
                calculateTotals();
            });

            // Quantity or price change
            KTUtil.on(e, '[data-kt-element="quantity"], [data-kt-element="price"], [data-kt-element="purchase_price"]', "change", function (e) {
                e.preventDefault();
                calculateRow(this);
            });
        }
    };
}();

// Initialize on DOM ready
KTUtil.onDOMContentLoaded(function () {
    KTAppInvoicesCreate.init();
});
