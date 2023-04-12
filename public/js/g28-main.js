/*
 * This is the main javascript file of g28 bootstrap framework.
 * This should be included in the header section of the HTML/PHP file.
*/

// Declaring config variables
let configs = {
    stage: undefined
}


// Utils
const isDev = (configs.stage === 'development');

const logger = (output) => {
    if (isDev) {
        console.log(output);
    }
}

const initConfigs = (obj = {}) => {
    for (let property in obj) {
        // looping through the properties of the obj
        if (typeof obj[property] !== 'undefined' || obj[property] !== null) {
            if (typeof configs[property] === 'undefined' || configs[property] === null) {
                configs[property] = obj[property];
            }
        }
    }
}