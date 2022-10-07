  
function decodeOnce(codeReader, selectedDeviceId) {
  codeReader.decodeFromInputVideoDevice(selectedDeviceId, 'video').then((result) => {
    console.log(result)
    function maPosition(position) {
      var infopos = "";
      infopos += position.coords.latitude +",";  
      infopos += position.coords.longitude;
      console.log(infopos);
        if(infopos >= "45.739525, 3.722632" & infopos <= "50.740152, 5.721361" ){
        setTimeout(document.location.href=result.text, 2000);
        }else{
          console.log("error position");
        }
    }
    
    if(navigator.geolocation)
      navigator.geolocation.getCurrentPosition(maPosition);
  //   $.ajax({
  //     url: "assets/includes/cards.php",
  //     method: "POST",
  //     data: result,
  //     success: function(data) {
  //         if(result.text === data){

  //       // document.getElementById('result').textContent = result.text
  //             setTimeout(document.location.href=result.text, 2000);
  //         }else{
  //           document.getElementById('error').textContent = "qrcode non correct"
  //         }
  //     }
  // });

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
        codeReader.reset()
        document.getElementById('display').style.display="none";
         document.getElementById('startButton').style.display="none";
         document.getElementById('error').textContent = "";
        
        // document.getElementById('result').textContent = '';
        console.log('Reset de l\'appli')

      })

    })
    .catch((err) => {
      console.error(err)
    })
})
