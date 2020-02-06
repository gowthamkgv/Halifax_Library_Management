import java.io.File;
import java.io.FileNotFoundException;
import java.io.PrintWriter;
import java.util.Scanner;

/**
 * This application is built to change the csv file into json file which can be
 * imported by mongoDB.
 *
 * @author YilongWu (A00429725)
 */
public class csv2json {

    public static void main(String[] args) throws FileNotFoundException {
        File file = new File("./author.csv");
        Scanner fin = new Scanner(file);
        PrintWriter fout = new PrintWriter(new File("AUTHOR.json"));

        // read the data from the csv.file
        fout.println("[");
        while (fin.hasNext()) {

            String temp1 = fin.nextLine();
            String[] temp = temp1.split(",");

            //change format(author_lname column has extra space))
            temp[1] = temp[1].replace(" ", "");

            // output the result
            if (!"Author_id".equals(temp[0])) {
                if (fin.hasNext()) {
                    fout.println("   {\"Author_id\":\"" + temp[0]
                            + "\",\"Au_lname\":\"" + temp[1]
                            + "\",\"Au_fname\":\"" + temp[2]
                            + "\",\"Email\":\"" + temp[3] + "\"},");
                } else {
                    fout.println("   {\"Author_id\":\"" + temp[0]
                            + "\",\"Au_lname\":\"" + temp[1]
                            + "\",\"Au_fname\":\"" + temp[2]
                            + "\",\"Email\":\"" + temp[3] + "\"}");
                }
            }
        }

        fout.println("]");
        fin.close();
        fout.close();

    }

}
