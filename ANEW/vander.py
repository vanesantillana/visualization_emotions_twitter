from vaderSentiment.vaderSentiment import SentimentIntensityAnalyzer
#note: depending on how you installed (e.g., using source code download versus pip install), you may need to import like this:
#from vaderSentiment import SentimentIntensityAnalyzer

# --- examples -------
sentences = ["Contented",  # positive sentence example
             "Serene",  # punctuation emphasis handled correctly (sentiment intensity adjusted)
             "relaxed", # booster words handled correctly (sentiment intensity adjusted)
             "calm",  # emphasis for ALLCAPS handled
             "lethargic", # combination of signals - VADER appropriately adjusts intensity
             "bored", # booster words & punctuation make this close to ceiling for score
             "depressed",  # negation sentence example
             "sad",  # positive sentence
             "upset",  # negated negative sentence with contraction
             "stressed", # qualified positive sentence is handled correctly (intensity adjusted)
             "nervous", # mixed negation sentence
             "tense",  # negative slang with capitalization emphasis
             "alert", # mixed sentiment example with slang and constrastive conjunction "but"
             "excited",  # emoticons handled
             "elated",  # emojis handled
             "happy"  # Capitalized negation
             ]

analyzer = SentimentIntensityAnalyzer()
dic = {}
for sentence in sentences:
    vs = analyzer.polarity_scores(sentence)
    dic[sentence]=vs['compound']
    print("{:-<65} {}".format(sentence, str(vs)).encode("utf-8"))

for key, value in sorted(dic.items(), key=lambda item: (item[1], item[0])):
    print ("%s: %s" % (key, value))
