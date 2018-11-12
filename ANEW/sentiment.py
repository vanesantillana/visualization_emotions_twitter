import anew

with open("result/coments.csv", 'r', encoding='utf-8') as f:
    content = f.readlines()

import csv
with open('result/sentimiento.csv', 'w', encoding='utf-8') as csvfile:
    sentiment_writer = csv.writer(csvfile, delimiter=',',
                            quotechar='"', quoting=csv.QUOTE_MINIMAL)
    sentiment_writer.writerow(["Valence", "Arousal", "Comentario"])
    for line in content:
        if line.strip():
            line_to_word = line.split("|")
            sentiment_attributes = anew.sentiment(line_to_word[0].split())
            sentiment_writer.writerow([
                                        sentiment_attributes['valence'],
                                        sentiment_attributes['arousal'],
                                        line_to_word[0].strip()])
print('Termine de analizar con ANEW')