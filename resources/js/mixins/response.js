export default {
    methods: {
        parseResponse: function (result, type = 1, title = null, option = {}) {
            /* Set needed variables */
            let message = '';
            let hasResponse = false, hasData = false, hasMultiError = false;


            if (typeof result === 'string') {
                message = result;
            }

            if (typeof result !== 'undefined') {
                /* Fetch and add in message */
                if (result.hasOwnProperty('message')) {
                    message = result.message;
                }
            }

            if (typeof result.data !== 'undefined') { //alert(result.response.status);
                if (result.data.hasOwnProperty('message') && result.data.message.length > 0) {
                    message = result.data.message;
                }
            }

            if (typeof result.response !== 'undefined') { //alert(result.response.status);
                /* Set needed checker vars; */
                hasData = result.response.hasOwnProperty('data');
                /* Fetch and add in response error message */
                if (hasData) {
                    if (result.response.data.hasOwnProperty('message') && result.response.data.message.length > 0) {
                        message = result.response.data.message;
                    }
                }

                /* Setup generic response messages only for error & warning response */
                if (type == 0 || type == 1) {
                    switch (result.response.status) {
                        case 404: message = 'Invalid or missing route';
                            break;
                        case 405: message = 'Method not allowed on route';
                            break;
                        case 422:

                            /* Check for errors field */
                            if (hasData) {
                                if (result.response.data.hasOwnProperty('errors')) {
                                    let fieldsArray = result.response.data.errors; //console.log(fieldsArray);
                                    /* Set multi-line error trigger */
                                    hasMultiError = true;
                                    /* Set error var for hasError() */
                                    this.errors = fieldsArray;

                                    /* Fetch each error per item */
                                    for (let field in fieldsArray) { //console.log(field);
                                        for (let subfield in fieldsArray[field]) { //console.log(fieldsArray[field][subfield]);
                                            message += '<li>' + fieldsArray[field][subfield] + '</li>';
                                        }
                                    } //console.log(errorsMsg);
                                }
                            }

                            break;
                        case 500: message = 'Something went wrong. Kindly try refresh the app.';
                            break;
                    }
                }
            }

            return message;
        },
    }
}