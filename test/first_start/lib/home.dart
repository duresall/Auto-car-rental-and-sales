import 'package:flutter/material.dart';

class Homepage extends StatelessWidget {
  const Homepage({super.key});

  @override
  Widget build(BuildContext context) {
    return const Scaffold(
//lets creat a login page
      body: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Center(
            child: Text(
              "Login",
              style: TextStyle(fontSize: 30),
            ),
          ),
          Padding(
            padding: EdgeInsets.symmetric(horizontal: 8, vertical: 3),
            child: TextField(
              decoration: InputDecoration(
                  hintText: "Enter Email",
                  suffix: Icon(Icons.email),
                  border: OutlineInputBorder(
                    borderRadius: BorderRadius.all(Radius.circular(10)),
                  )),
            ),
          ),
          Padding(
            padding: EdgeInsets.all(8.0),
            child: TextField(
              obscureText: true,
              decoration: InputDecoration(
                  hintText: "password",
                  suffixIcon: Icon(Icons.remove_red_eye),
                  border: OutlineInputBorder(
                    borderRadius: BorderRadius.all(Radius.circular(10)),
                  )),
            ),
          ),
          ElevatedButton(
              onPressed: null, child: Text("Login"), style: ButtonStyle())
        ],
      ),
    );
  }
}
