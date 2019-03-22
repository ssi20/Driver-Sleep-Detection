# USAGE
# python detect_drowsiness.py --shape-predictor shape_predictor_68_face_landmarks.dat
# python detect_drowsiness.py --shape-predictor shape_predictor_68_face_landmarks.dat --alarm alarm.wav

# import the necessary packages
from scipy.spatial import distance as dist
import mysql.connector
import MySQLdb
import datetime
from imutils.video import VideoStream
from imutils import face_utils
from threading import Thread
import numpy as np
import playsound
import argparse
import imutils
import time
import dlib
import cv2
time1=0
min1=0
DROWSY = 0,
VISIBILITY = 0,
PICTURE = 0
PICTURE1=0

def insert():

	cnx = mysql.connector.connect(host="localhost",
	user="root",
	passwd="",
	database="cyrus")
	cursor = cnx.cursor()
	add_salary = ("INSERT INTO session "
				"(s_id,drowse, visibility,s_time, picture, glare) "
				"VALUES (%(s_id)s,%(drowse)s, %(visibility)s,%(s_time)s, %(picture)s, %(glare)s)")

	data_salary = {
	's_id': 2,
	'drowse': DROWSY,
	'visibility': VISIBILITY,
	'picture': PICTURE1,
	's_time' : datetime.datetime.now(),
	'glare': 0,
	}
	cursor.execute(add_salary, data_salary)

	cnx.commit()

	

	print(cursor.rowcount, "record inserted.")

def adjust_gamma(image, gamma=1.0):
	# build a lookup table mapping the pixel values [0, 255] to
	# their adjusted gamma values
    invGamma = 1.0 / gamma
    table = np.array([((i / 255.0) ** invGamma) * 255
        for i in np.arange(0, 256)]).astype("uint8")
 
	# apply gamma correction using the lookup table
    return cv2.LUT(image, table)



def sound_alarm(path):
	# play an alarm sound
	playsound.playsound(path)

def eye_aspect_ratio(eye):
	# compute the euclidean distances between the two sets of
	# vertical eye landmarks (x, y)-coordinates
	A = dist.euclidean(eye[1], eye[5])
	B = dist.euclidean(eye[2], eye[4])

	# compute the euclidean distance between the horizontal
	# eye landmark (x, y)-coordinates
	C = dist.euclidean(eye[0], eye[3])

	# compute the eye aspect ratio
	ear = (A + B) / (2.0 * C)

	# return the eye aspect ratio
	return ear
 
# construct the argument parse and parse the arguments
ap = argparse.ArgumentParser()
ap.add_argument("-p", "--shape-predictor", required=True,
	help="path to facial landmark predictor")
ap.add_argument("-a", "--alarm", type=str, default="",
	help="path alarm .WAV file")
ap.add_argument("-w", "--webcam", type=int, default=0,
	help="index of webcam on system")
args = vars(ap.parse_args())
 

EYE_AR_THRESH = 0.3
EYE_AR_CONSEC_FRAMES = 48


# initialize the frame counter as well as a boolean used to
# indicate if the alarm is going off
COUNTER = 0
TOTAL   =0
ALARM_ON = False


# initialize dlib's face detector (HOG-based) and then create
# the facial landmark predictor
print("[INFO] loading facial landmark predictor...")
detector = dlib.get_frontal_face_detector()
predictor = dlib.shape_predictor(args["shape_predictor"])

# grab the indexes of the facial landmarks for the left and
# right eye, respectively
(lStart, lEnd) = face_utils.FACIAL_LANDMARKS_IDXS["left_eye"]
(rStart, rEnd) = face_utils.FACIAL_LANDMARKS_IDXS["right_eye"]

# start the video stream thread
print("[INFO] starting video stream thread...")
vs = VideoStream(src=args["webcam"]).start()
time.sleep(1.0)
count=0
blink=0
pblink=0
slfrm=0
flg=0
# loop over frames from the video stream
while True:
	# grab the frame from the threaded video file stream, resize
	# it, and convert it to grayscale
	# channels)
	frame = vs.read()
	frame = imutils.resize(frame, width=450)
	t2=cv2.cvtColor(frame, cv2.COLOR_BGR2HSV)
	h,s,v = cv2.split(t2)
	vmean=np.mean(v)
	#print(vmean)

	DROWSY =0
	
	VISIBILITY=1
	


	if vmean <75:
		gamma=2.5
	elif vmean >100 and vmean <120:
		gamma=0.8
	elif vmean >120:
		gama=0.5
	else:
		gamma=1

	frame = adjust_gamma(frame,gamma=gamma)
	'''frame=cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
	clahe = cv2.createCLAHE(clipLimit=2.0, tileGridSize=(8,8))
	frame = clahe.apply(frame)'''

	#frame=cv2.cvtColor(frame, cv2.COLOR_GRAY2RGB)
	#frame1=cv2.cvtColor(frame1, cv2.COLOR_BGR2RGB)

	if(vmean<50):
		cv2.putText(frame, "Dark Environment Detected", (10, 60),cv2.FONT_HERSHEY_SIMPLEX, 0.6, (0, 0, 255), 2)

	cv2.putText(frame, "g={}".format(gamma), (50, 80),cv2.FONT_HERSHEY_SIMPLEX, 0.6, (0, 0, 255), 2)
	#cv2.imshow("Images", frame  )#np.hstack([original, adjusted]))
	#cv2.waitKey(0)
	gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)

	# detect faces in the grayscale frame
	rects = detector(gray, 0)
	
	#slfrm+=1
	
	# loop over the face detections
	for rect in rects:
	
		
		shape = predictor(gray, rect)
		shape = face_utils.shape_to_np(shape)

		
		leftEye = shape[lStart:lEnd]
		rightEye = shape[rStart:rEnd]
		leftEAR = eye_aspect_ratio(leftEye)
		rightEAR = eye_aspect_ratio(rightEye)

		
		ear = (leftEAR + rightEAR) / 2.0

		leftEyeHull = cv2.convexHull(leftEye)
		rightEyeHull = cv2.convexHull(rightEye)
		#print(leftEyeHull)
		cv2.drawContours(frame, [leftEyeHull], -1, (0, 255, 0), 1)
		cv2.drawContours(frame, [rightEyeHull], -1, (0, 255, 0), 1)
		print("SLframe",slfrm,"blink",blink,'pblink',pblink)
		if ear < EYE_AR_THRESH:
			COUNTER += 1
			TOTAL +=1
			blink+=1
			slfrm=0
			if COUNTER >= EYE_AR_CONSEC_FRAMES:
				
				# if the alarm is not on, turn it on
				if not ALARM_ON:
					ALARM_ON = True

					
					if args["alarm"] != "":
						t = Thread(target=sound_alarm,
							args=(args["alarm"],))
						t.deamon = True
						t.start()

				# draw an alarm on the frame
				DROWSY= 1

				time2=int(datetime.datetime.now().strftime('%S'))
				min2=int(datetime.datetime.now().strftime('%M'))
				print("m1",min1,"m2",min2,"s1",time1,"s2",time2)
				diffmin= abs(min2-min1)
				diff= abs(time2-time1)
				print("diffmin",diffmin,"diffsec",diff)
				
				if diff>5 or diffmin>0:
					insert()
					time1=time2
					min1=min2
					print("new value",time1,time2)

				
				
				cv2.putText(frame, "DROWSINESS ALERT!", (10, 30),
					cv2.FONT_HERSHEY_SIMPLEX, 0.7, (0, 0, 255), 2)

			
		elif ear >  EYE_AR_THRESH :
			pblink=blink
			COUNTER = 0
			ALARM_ON = False
			print(TOTAL)
		'''if (TOTAL<40):
			if PICTURE==0:
				PICTURE=1
				PICTURE1=1
				insert()
				PICTURE1=0
			cv2.putText(frame, "PICTURE", (10, 30),
				cv2.FONT_HERSHEY_SIMPLEX, 0.7, (0, 0, 255), 2)'''
		
		if (blink-pblink==0):
			
			slfrm+=1
			
		if(slfrm>40):
			#time.sleep(1.0)
			slfrm=0
			flg+=1
			if PICTURE==0:
				PICTURE=1
				PICTURE1=1
				insert()
				PICTURE1=0
			
		
		if 0<flg<=10:
			cv2.putText(frame, "PICTURE", (10, 30),
				cv2.FONT_HERSHEY_SIMPLEX, 0.7, (0, 0, 255), 2)
			flg+=1
		else:
			flg=0

		cv2.putText(frame, "EAR: {:.2f}".format(ear), (300, 30),
			cv2.FONT_HERSHEY_SIMPLEX, 0.7, (0, 0, 255), 2)

	if not rects:
		VISIBILITY=1
		
		time2=int(datetime.datetime.now().strftime('%S'))
		min2=int(datetime.datetime.now().strftime('%M'))
		print("m1",min1,"m2",min2,"s1",time1,"s2",time2)
		diffmin= abs(min2-min1)
		diff= abs(time2-time1)
		print("diffmin",diffmin,"diffsec",diff)
		
		if diff>5 or diffmin>0:
			insert()
			time1=time2
			min1=min2
			print("new value",time1,time2)

				
				
		
		cv2.putText(frame, "Eyes not visible", (10, 30),
			cv2.FONT_HERSHEY_SIMPLEX, 0.7, (0, 0, 255), 2)



		


		# draw the computed eye aspect ratio on the frame to help
		# with debugging and setting the correct eye aspect ratio
		# thresholds and frame counters
		
		'''if(TOTAL<40):	
			cv2.putText(frame, "PICTURE", (10, 30),
				cv2.FONT_HERSHEY_SIMPLEX, 0.7, (0, 0, 255), 2)
		elif( (len(rightEyeHull[0])==0 or  len(leftEyeHull[0])==0) ):   #face_detection(frame)==1 and 
				cv2.putText(frame, "Eyes not visible", (10, 30),
					cv2.FONT_HERSHEY_SIMPLEX, 0.7, (0, 0, 255), 2)'''

		

 
	# show the frame
	cv2.imshow("Frame", frame)
	key = cv2.waitKey(1) & 0xFF
	
	# if the `q` key was pressed, break from the loop
	if key == ord("q"):
		break

# do a bit of cleanup
cv2.destroyAllWindows()
vs.stop()