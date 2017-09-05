function show_attendee_finance_data(finance_data) {
    jQuery(document).ready(function() {
        jQuery(".eventtable td:eq(1)").append(finance_data);
    })
}