import CSVFileValidator from 'csv-file-validator'


const requiredError = (headerName, rowNumber, columnNumber) => {
  return `<div class="warning">${headerName} is required in <strong>row: ${rowNumber} </strong> | <strong>column: ${columnNumber}</strong></div>`
}
const validateError = (headerName, rowNumber, columnNumber) => {
  return `<div class="warning">${headerName} is not valid in <strong>row: ${rowNumber} </strong> | <strong>column: ${columnNumber}</strong></div>`
}
const uniqueError = (headerName) => {
  return `<div class="warning">You must use a unique <strong>${headerName}</strong></div>`
}
const isBlank = function (orderFilled) {
  return orderFilled.length == 0
}
const showValue = function (inputName) {
  let testing = JSON.stringify(inputName)
  return testing.valueOf()
}
const isEmailValid = function (email) {
  const reqExp = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/
  return reqExp.test(email)
}
const stateLength = function (state) {
  return state.length === 2
}

const CSVConfig = {
  headers: [
      { name: 'Order Number', inputName: 'orderNumber', required: true, requiredError, unique: true, uniqueError },
      { name: 'Order Placed', inputName: 'orderPlaced', required: true, requiredError, showValue },
      { name: 'Order Fulfilled', inputName: 'orderFilled', required: false, validate: isBlank, validateError },
      { name: 'Item Description', inputName: 'itemDesc', required: true, requiredError, isArray: true},
      { name: 'Customer Email', inputName: 'email', required: true, requiredError, unique: true, uniqueError, validate: isEmailValid, validateError },
      { name: 'Customer First Name', inputName: 'firstName', required: true, requiredError },
      { name: 'Customer Last Name', inputName: 'lastName', required: true, requiredError },
      { name: 'Customer Address 1', inputName: 'address1', required: true, requiredError },
      { name: 'Customer Address 2', inputName: 'address2', required: false, validateError },
      { name: 'Customer City', inputName: 'city', required: true, requiredError },
      { name: 'Customer State', inputName: 'state', required: true, requiredError, validate: stateLength, validateError },
      { name: 'Customer Zip', inputName: 'zip', required: true, requiredError },
      { name: 'Phone Number', inputName: 'phoneNumber', required: true, requiredError }
  ]
}

document.getElementById('file').onchange = function(event) {
  let feedback = document.getElementById('invalidMessages')

  CSVFileValidator(event.target.files[0], CSVConfig)
      .then(csvData => {
        if (csvData.inValidMessages != "") {
          csvData.inValidMessages.forEach(message => {
            feedback.style.display = 'block'
            feedback.insertAdjacentHTML('beforeend', message)
          })
          feedback.insertAdjacentHTML('afterbegin', "Please fix the following issues:")
        } else {
          feedback.style.display = 'block'
          feedback.insertAdjacentHTML('afterbegin', '<div class="success">You did it! This order is valid.</div>')
          
        }
          console.log(csvData.data)
      })
}

