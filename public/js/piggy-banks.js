$(function () {
    $('.addMoney').on('click', addMoney);
    $('.removeMoney').on('click', removeMoney);

    if (typeof(googleLineChart) === 'function' && typeof(piggyBankID) !== 'undefined') {
        googleLineChart('chart/piggy-history/' + piggyBankID, 'piggy-bank-history');
    }
});

function addMoney(e) {
    var pigID = parseInt($(e.target).data('id'));
    $('#moneyManagementModal').empty().load('piggy-banks/add/' + pigID).modal('show');

    return false;
}

function removeMoney(e) {
    var pigID = parseInt($(e.target).data('id'));
    $('#moneyManagementModal').empty().load('piggy-banks/remove/' + pigID).modal('show');

    return false;
}