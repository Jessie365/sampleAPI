# sampleAPI
Sample PHP API based on Laravel Framework
# Live API DEMO
You can give it a try at: <a href="https://jessie365.com/api/posts">https://jessie365/api/{command}</a>
# Commands Supported
<strong>1. Register user:</strong> <br />
CREATE POST Request to URL: hostname/api/users <br />
The body of the <strong>request</strong> must contain these fields in JSON format:
<ul>
    <li>name</li>
    <li>email</li>
    <li>password</li>
    <li>password_confirmation</li>
</ul>
<strong>2. Log in | Authenticate user:</strong> <br />
CREATE POST Request to URL: hostname/api/auth <br />
The body of the <strong>request</strong> must contain these fields in JSON format:
<ul>
    <li>email</li>
    <li>password</li>
</ul>
RETURNS: <strong>access token</strong> for executing commands that needs authentication
when valid credentials are entered. <br /><br />
<strong>3. Create Post:</strong> <br />
CREATE POST Request to URL: hostname/api/posts <br />
The body of the <strong>request</strong> must contain these fields in JSON format:
<ul>
    <li>title</li>
    <li>body</li>
</ul>
<strong>*Creating Post requires authenticated user:</strong>
Provide the token in the <strong>request header</strong> as follows: <br />
name: 'Authorization'; value: 'Bearer {TOKEN_HERE}' <br /> <br />
<strong>4. Create Comment:</strong> <br />
CREATE POST Request to URL: hostname/api/posts/{postId}/comments <br />
The body of the <strong>request</strong> must contain these fields in JSON format:
<ul>
    <li>body</li>
</ul>
<strong>*Creating Post requires authenticated user:</strong>
Provide the token in the <strong>request header</strong> as follows: <br />
name: 'Authorization'; value: 'Bearer {TOKEN_HERE}' <br /> <br />
<strong>5. Show list of posts:</strong> <br />
CREATE GET Request to URL: hostname/api/posts <br />
RETURNS: List of posts <strong>ordered by</strong> creation date DESCENDING <br />
PARAMS: Use hostname/api/posts/?orderBy=comments to get a list of posts <strong>ordered by</strong> most comments
