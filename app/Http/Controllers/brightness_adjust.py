#rom __future__ import print_function
import numpy as np
import argparse
import cv2
import imutils
from imutils.video import VideoStream
import time
 
def adjust_gamma(image, gamma=1.0):
	# build a lookup table mapping the pixel values [0, 255] to
	# their adjusted gamma values
    invGamma = 1.0 / gamma
    table = np.array([((i / 255.0) ** invGamma) * 255
        for i in np.arange(0, 256)]).astype("uint8")
 
	# apply gamma correction using the lookup table
    return cv2.LUT(image, table)


# construct the argument parse and parse the arguments
ap = argparse.ArgumentParser()
'''ap.add_argument("-i", "--image", required=True,
	help="path to input image")
args = vars(ap.parse_args())'''

ap.add_argument("-w", "--webcam", type=int, default=0,
	help="index of webcam on system")
args = vars(ap.parse_args())
 

# start the video stream thread
print("[INFO] starting video stream thread...")
vs = VideoStream(src=args["webcam"]).start()
time.sleep(1.0)
gamma=1
# loop over frames from the video stream
while True:
	# grab the frame from the threaded video file stream, resize
	# it, and convert it to grayscale
	# channels)
    frame = vs.read()
    frame= imutils.resize(frame, width=450)
    #temp=cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)



    #Copy from here                                                        
    ########--------------------------------------------------------------------------------#############
    t2=cv2.cvtColor(frame, cv2.COLOR_BGR2HSV)
    h,s,v = cv2.split(t2)
    vmean=np.mean(v)
    print(vmean)

    if vmean <75:
        gamma=2
    elif vmean >90 and vmean <110:
        gamma=0.8
    elif vmean >110:
        gama=0.5
    else:
        gamma=1

    frame1 = adjust_gamma(frame,gamma=gamma)
    '''frame=cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    clahe = cv2.createCLAHE(clipLimit=2.0, tileGridSize=(8,8))
    frame = clahe.apply(frame)'''

    #frame=cv2.cvtColor(frame, cv2.COLOR_GRAY2RGB)
    frame1=cv2.cvtColor(frame1, cv2.COLOR_BGR2RGB)

    if(vmean<50):
        cv2.putText(frame1, "Dark Environment Detected", (20, 30),cv2.FONT_HERSHEY_SIMPLEX, 0.8, (0, 0, 255), 3)

    cv2.putText(frame1, "g={}".format(gamma), (10, 30),cv2.FONT_HERSHEY_SIMPLEX, 0.8, (0, 0, 255), 3)
	#cv2.imshow("Images", frame  )#np.hstack([original, adjusted]))
	#cv2.waitKey(0)

    ######-----------------------------------------------------------------####


    # show the frame
    cv2.imshow("t2", frame1)
    key = cv2.waitKey(1) & 0xFF
 
	# if the `q` key was pressed, break from the loop
    if key == ord("q"):
        break
 
# do a bit of cleanup
cv2.destroyAllWindows()
vs.stop()


	
 
	
 
