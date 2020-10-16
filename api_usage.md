
## Face Mask Detection API Documentation

This Face Mask Detection consists of two modules.
* Module I uses the image classification method.
* Module II uses the object detection method.
 
 Both of the modules require an Image Processing library (like OpenCV, Pillow, etc.) compatibility on a remote device.
 In addition, Module I requires face dection mechanism present in the remote device.

### Face mask detection API Module I usage documentation

The server model which has been deployed is using tensorflow server on an AWS instance.
The TF server expects its API request in a particular format of a list of lists (in Python).


This can be seen in the following example

```python

import json

data = json.dumps({"signature_name": "serving_default", "instances": test_images.tolist()})

```

A few points to note here 
* The input to the API is a list of the cropped face from the image
* You need to convert the image into a list of lists (a 2D list in python or its equivalent in other languages)


To make a request, run the following code

```py

import requests

headers = {"content-type": "application/json"}

json_response = requests.post('http://[SERVER IP ADD]:[PORT NUMBER]/v1/models/[MODEL NAME]:predict', data=data, headers=headers)

predictions = json.loads(json_response.text)['predictions']

```


The predictions obtained would be a list of outputs you have trained your model to give an output of ex an image classification model will contain a list of values indicating the probabilities of each class.



### Face mask detection API Module II usage documentation 


The Module II of this API provides two features:   
1. Face Mask Detection on a single Image.
2. Facemask detection in live camera feed.

Following are the instructions to use these features.

#### 1. Face Mask Detection on a single Image.

* This method is developed to work with a single image.
* User shall can us this feature by submitting a POST request with form data as a test image.
* General HTML forms could be used to select the image and submit POST request, the request shall be sent to the following address:
http://[ip_address_of_server]:[port_number]/extraction
The default port number is 8080.
* The response from the server will be Bounding Box Co-ordinates and the class name of the faces detected in the image.
* Any API testing tool can be also used to use this api features. (e.g. form data can be requested using tools like Postman)
* Image Processing library from the remote device shall be used to visulize the results.

#### 2. Facemask detection in live camera feed.

* This method is developed to work live camera outputs. We can use these feature to identify face masks in real-time.
* User shall can us this feature by submitting a POST request with JSON data.
* The format of the JSON data must be as follows: {"signature_name": "serving_default", "instances": [frame_image_in_list/array_format]}
In this format the key:value pair "signature_name":"serving_default" is constant, and the value to the key "instances" shall be the image in the form of array.
* We can obtain the image in the form of array, by converting the image vector that is obtained through Image Processing library on the remote device to array. (list of list in Python)
* The request shall be sent to the following address: http://[ip_address_of_server]:[port_number]/extraction_live
The default port number is 8080.
* The response from the server will be Bounding Box Co-ordinates and the class name of the faces detected in the image.
* Image Processing library from the remote device shall be used to visulize the results.

Example usage of 2<sup>nd</sup> feature of Module II (In Python 3.x):

Image Processing library named OpenCV is installed on the remote device.
```python
import json
import numpy as np
import cv2
import requests
import imutils
import os 
 
#initialize the video stream and allow the camera sensor to warm up
print("[INFO] starting video stream...")
cap = cv2.VideoCapture(0)
 
while (cap.isOpened()):
    #grab the frame from the threaded video stream and resize it
    #to have a maximum width of 400 pixels
    ret, frame = cap.read()
    #cv2.imshow("Frame", frame)
    key = cv2.waitKey(1) & 0xFF
    data = json.dumps({"signature_name": "serving_default", "instances": frame.tolist()})
    json_response = requests.post('http://3.7.249.114:8080/extraction_live', data=data, headers= {"content-type": "application/json"})
    print(json_response.json())
    print(type(json_response))
    cv2.imshow("Frame", frame)
    #mask_preds = json.loads(json_response)
    #print(mask_preds)
    #if the `q` key was pressed, break from the loop
    if key == ord("q"):
        break

#do a bit of cleanup
cv2.destroyAllWindows()
cap.release()
```

>Note: Because of the classification mechanism Module I works faster than Module II
