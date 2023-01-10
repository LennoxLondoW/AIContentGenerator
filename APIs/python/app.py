#!C:\python\python.exe
from flask import Flask, request
import openai
print("Content-Type: text/html\n\n")
# Import modules for CGI handling


# Create instance of FieldStorage


# install openai pip install
app = Flask(__name__)

@app.route('/')
def index():
    args = request.args
    # check if the parameters are set
    if "prompt" in args.keys() and "tokens" in args.keys():
        prompt = args.get("prompt")
        tokens = args.get("tokens")
        openai.api_key = "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"

        response = openai.Completion.create(
            model="text-davinci-003",
            prompt=prompt,
            temperature=0.7,
            max_tokens=int(tokens),
            top_p=1.0,
            frequency_penalty=0.0,
            presence_penalty=0.0
        )

        print(response)

    return "Hello World"  # render_template('index.html')

if (__name__ == "__main__"):
    app.run(debug=False)
