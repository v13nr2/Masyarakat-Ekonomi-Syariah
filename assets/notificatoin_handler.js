checkNotifications = function (params, updateStatus) {
    if (params && params.notificationUrl) {
        $.ajax({
            url: params.notificationUrl,
            dataType: 'json',
            success: function (result) {
                if (result.success) {
                    if (result.total_notifications && result.total_notifications * 1) {
                        params.notificationSelector.html("<i class='fa " + params.icon + "'></i> <span class='badge bg-danger up'>" + result.total_notifications + "</span>");
                    }

                    params.notificationSelector.parent().find(".dropdown-details").html(result.notification_list);

                    if (updateStatus) {
                        //update last notification checking time
                        $.ajax({
                            url: params.notificationStatusUpdateUrl,
                            success: function () {
                                params.notificationSelector.html("<i class='fa " + params.icon + "'></i>");
                            }
                        });
                    }
                }
                if (!updateStatus) {
                    //check notification again after sometime
                    var check_notification_after_every = params.checkNotificationAfterEvery;
                    check_notification_after_every = check_notification_after_every * 1000;
                    if (check_notification_after_every < 10000) {
                        check_notification_after_every = 10000; //don't allow to call this requiest before 10 seconds
                    }

                    setTimeout(function () {
                        checkNotifications(params);
                    }, check_notification_after_every);
                }
            }
        });
    }
};

