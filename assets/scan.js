  
function decodeOnce(codeReader, selectedDeviceId) {
  codeReader.decodeFromInputVideoDevice(selectedDeviceId, 'video').then((result) => {
    console.log(result)
    // document.getElementById('result').textContent = result.text
    setTimeout(document.location.href=result.text, 2000);
  }).catch((err) => {
    console.error(err)
    // document.getElementById('result').textContent = err
  })
}

function decodeContinuously(codeReader, selectedDeviceId) {
  codeReader.decodeFromInputVideoDeviceContinuously(selectedDeviceId, 'video', (result, err) => {
    if (result) {
      // properly decoded qr code
      console.log('QR code trouvé!', result)
      // document.getElementById('result').textContent = result.text
      console.log( result.text);
    }

    if (err) {
      // As long as this error belongs into one of the following categories
      // the code reader is going to continue as excepted. Any other error
      // will stop the decoding loop.
      //
      // Excepted Exceptions:
      //
      //  - NotFoundException
      //  - ChecksumException
      //  - FormatException

      if (err instanceof ZXing.NotFoundException) {
        console.log('No QR code found.')
      }

      if (err instanceof ZXing.ChecksumException) {
        console.log('A code was found, but it\'s read value was not valid.')
      }

      if (err instanceof ZXing.FormatException) {
        console.log('A code was found, but it was in a invalid format.')
      }
    }
  })
}

window.addEventListener('load', function () {
  let selectedDeviceId;
  const codeReader = new ZXing.BrowserQRCodeReader()
  console.log('Bon chargements du code')

  codeReader.getVideoInputDevices()
    .then((videoInputDevices) => {
      const sourceSelect = document.getElementById('sourceSelect')
      selectedDeviceId = videoInputDevices[0].deviceId
      if (videoInputDevices.length >= 1) {
        videoInputDevices.forEach((element) => {
          const sourceOption = document.createElement('option')
          sourceOption.text = element.label
          sourceOption.value = element.deviceId
          sourceSelect.appendChild(sourceOption)
        })

        sourceSelect.onchange = () => {
          selectedDeviceId = sourceSelect.value;
          const decodingStyle = document.getElementById('decoding-style').value;
          if (decodingStyle == "once") {
            decodeOnce(codeReader, selectedDeviceId);
            document.getElementById('display').style.display="block";
          } else {
            decodeContinuously(codeReader, selectedDeviceId);
          }
        };

        const sourceSelectPanel = document.getElementById('sourceSelectPanel')
        sourceSelectPanel.style.display = 'block'
      }

      document.getElementById('startButton').addEventListener('click', () => {

        const decodingStyle = document.getElementById('decoding-style').value;
        if (decodingStyle == "once") {
          decodeOnce(codeReader, selectedDeviceId);
          document.getElementById('display').style.display="block";
          document.getElementById('startButton').style.display="none";
        } else {
          decodeContinuously(codeReader, selectedDeviceId);
        }

        console.log(`start decodage de la camera et fourni id: ${selectedDeviceId}`)
      })

      document.getElementById('resetButton').addEventListener('click', () => {
       document.getElementById('display').style.display="none";
        document.getElementById('startButton').style.display="none";
        codeReader.reset()
        
        // document.getElementById('result').textContent = '';
        console.log('Reset de l\'appli')

      })

    })
    .catch((err) => {
      console.error(err)
    })
})
