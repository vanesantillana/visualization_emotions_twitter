import anew

with open("result/comentarios.txt", 'r') as f:
    content = f.readlines()


import csv
with open('result/sentimiento.csv', 'w') as csvfile:
    sentiment_writer = csv.writer(csvfile, delimiter=',',
                            quotechar='"', quoting=csv.QUOTE_MINIMAL)
    sentiment_writer.writerow(["Comentario",  "Valence", "Arousal"])
    for line in content:
        if line.strip():
            line_to_word = line.split("|")
            sentiment_attributes = anew.sentiment(line_to_word[0].split())
            sentiment_writer.writerow([line_to_word[0].strip(),
                                        sentiment_attributes['valence'],
                                        sentiment_attributes['arousal']])
print('Termine de analisar con ANEW')