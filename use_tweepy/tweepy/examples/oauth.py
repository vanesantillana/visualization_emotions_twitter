from __future__ import absolute_import, print_function
from vaderSentiment.vaderSentiment import SentimentIntensityAnalyzer

import tweepy
from datetime import timedelta

consumer_key = "XnIYDS57O52dL0jqLe1tHJXk0"
consumer_secret = "brO7q47DPVMPigqtN7OoCia5JHAV3EmgQv72oDsE2X6AUarjQ0"
access_token = "999323137836756992-hGbNHbAOQPmK6WI87RvQJaYiS2rnz80"
access_token_secret = "TimbW0tB3TtrjPmYhOHfLgDN40xEEy9kwXMDUwnOxuRds"

auth = tweepy.OAuthHandler(consumer_key, consumer_secret)
auth.set_access_token(access_token, access_token_secret)

api = tweepy.API(auth)

my_list = []
horas =[]
for tweet in tweepy.Cursor(api.search,
                           q='happy',
                           rpp=5,
                           result_type="recent",
                           include_entities=True,
                           lang="en").items(400):
    my_list.append(str(tweet.text.encode("utf-8"))[2:-1])
    horas.append(tweet.created_at)
    #print(tweet.created_at, " -- ", tweet.text.encode("utf-8"))

'''
for status in tweepy.Cursor(api.search,
                           q="trump",
                           count=100,
                           result_type='recent',
                           include_entities=True,
                           monitor_rate_limit=True, 
                           wait_on_rate_limit=True,
                           lang="en").items(5):

    eastern_time = status.created_at - timedelta(hours=4)
    edt_time = eastern_time.strftime('%Y-%m-%d %H:%M')

    print(edt_time, " --- ",status.user.name, status.text.encode("utf-8"))

'''
analyzer = SentimentIntensityAnalyzer()
import csv
with open('../../../ANEW/result/sentimiento1.csv', 'w', encoding='utf-8') as csvfile:
    sentiment_writer = csv.writer(csvfile, delimiter=',',
                            quotechar='"', quoting=csv.QUOTE_MINIMAL)
    sentiment_writer.writerow(["Valence", "Negativo","Neutro","Positivo","Creado","Comentario"])

    for sentence,hora in zip(my_list,horas):
        vs = analyzer.polarity_scores(sentence)
        sentiment_writer.writerow([
                                    vs['compound'],
                                    vs['neg'],
                                    vs['neu'],
                                    vs['pos'],
                                    hora,
                                    sentence])
        print(sentence,vs,"\n")
        #print("{:-<65} {}".format(sentence, str(vs)).encode("utf-8"))